<?php
/**
 *
 *
 */
class CActiveRecordExtended extends CActiveRecord
{

    /*
     * check if model has the attribute deleted
     */
    public function init()
    {
        if (!$this->hasAttribute('is_deleted')) {
            throw new Exception('Model '.get_class($this).' has no attribute "deleted"');
            return false;
        }
    }

    /*
     * SoftDelete, relation magic *_with_deleted
    */
    public function __call($name, $parameters)
    {
        if ($strpos=strpos($name, '_with_deleted') !== false) {
            $name = substr($name, 0, strlen($name) - $strpos - 12);
            if (isset($this->getMetaData()->relations[$name])) {
                // todo: was ist wenn schon mehrere scopes gesetzt sind?
                $this->getMetaData()->relations[$name]->scopes='deleted';
                return $this->getRelated($name, true);
            }
        } elseif (isset($this->getMetaData()->relations[$name])) {
            if ($this->getMetaData()->relations[$name]->scopes=='') {
                $this->getMetaData()->relations[$name]->scopes='default';
            } elseif ($this->getMetaData()->relations[$name]->scopes=='deleted') {
                $this->getMetaData()->relations[$name]->scopes='default';
            }
        }
        return parent::__call($name, $parameters);
    }


    /*
     * SoftDelete, set "default" scope and relation magic *_with_deleted
    */
    public function __get($name)
    {
        if ($strpos=strpos($name, '_with_deleted') !== false) {
            $name = substr($name, 0, strlen($name) - $strpos - 12);

            if (isset($this->getMetaData()->relations[$name])) {
                // todo: was ist wenn schon mehrere scopes gesetzt sind?
                $this->getMetaData()->relations[$name]->scopes='deleted';
                return $this->getRelated($name, true);
            }
        } elseif (isset($this->getMetaData()->relations[$name])) {
            if ($this->getMetaData()->relations[$name]->scopes=='') {
                $this->getMetaData()->relations[$name]->scopes='default';
            } elseif ($this->getMetaData()->relations[$name]->scopes=='deleted') {
                $this->getMetaData()->relations[$name]->scopes='default';
            }

            return $this->getRelated($name);
        }

        return parent::__get($name);

    }

    /*
     * delete with all relations is default
     */
    public function delete($deleteRelated = true)
    {
        $return = false;
        if (!$this->getIsNewRecord()) {
            Yii::trace(get_class($this).'.delete()', 'awt.db.ar.CActiveRecordExtended');
            // start transaction
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($this->beforeDelete()) {
                    if ($deleteRelated) {
                        // delete all related
                        foreach ($this->relations() as $name => $relation) {
                            // delete only HAS_MANY!
                            if ($relation[0] == self::HAS_MANY) {
                                foreach ($this->$name as $relModel) {
                                    $relModel->scenario = 'delete';
                                    if (!$relModel->delete($deleteRelated)) {
                                        //print_r($relModel->getErrors());
                                        throw new Exception('Related model could not be deleted');
                                    }
                                }
                            }
                        }
                    }
                    // set to is_deleted = 1
                    $this->is_deleted = 1;
                    // save and set return
                    $this->scenario = 'delete';
                    $return = $this->save();
                    if (!$return) {
                        throw new Exception(get_class($this).' could not be saved. '.print_r($this->getErrors(), true));
                        //print_r($this->getErrors());
                    }
                    $this->afterDelete();
                    // commit transaction
                    $transaction->commit();
                } else {
                    throw new Exception('BeforeDelete Exception');
                }
            } catch (Exception $e) {
                // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
                // Alle Änderungen (auch nested) werden rückgängig gemacht.
                $transaction->rollBack();
                //Yii::app()->end();
                //print_r($this->getErrors());
                Yii::log('Exception: '.$e->getMessage(), CLogger::LEVEL_ERROR, 'CActiveRecordExtended');
            }
        } else {
            throw new CDbException(Yii::t('error', 'The active record cannot be deleted because it is new'), 100001);
        }
        return $return;
    }

    /*
     *
     */
    public function deleteFinal($deleteRelated = true)
    {
        $return = false;
        if (!$this->getIsNewRecord()) {
            Yii::trace(get_class($this) . '.delete()', 'awt.db.ar.CActiveRecordExtended');
            // start transaction
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($this->beforeDelete()) {
                    if ($deleteRelated) {
                        // delete all related
                        foreach ($this->relations() as $name => $relation) {
                            // delete only HAS_MANY!
                            if ($relation[0] == self::HAS_MANY) {
                                foreach ($this->$name as $relModel) {
                                    $relModel->scenario = 'delete';
                                    if (!$relModel->deleteFinal($deleteRelated)) {
                                        throw new Exception('Related model could not be deleted');
                                    }
                                }
                            }
                        }
                    }

                    $this->scenario = 'delete';
                    // real delete
                    $return = parent::delete();
                    if (!$return) {
                        throw new Exception(get_class($this) . ' could not be deleted. ' . print_r($this->getErrors(), true));
                    }
                    // commit transaction
                    $transaction->commit();

                }
            } catch (Exception $e) {
                // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
                // Alle Änderungen (auch nested) werden rückgängig gemacht.
                $transaction->rollBack();
                Yii::log('Exception: ' . $e->getMessage(), CLogger::LEVEL_ERROR, 'CActiveRecordExtended');
            }
        } else {
            throw new CDbException(Yii::t('error', 'The active record cannot be deleted because it is new'), 100001);
        }
        //return parent::delete();
        return $return;
    }

    /*
     * Restore a deleted entry
     */
    public function restore($withRelated = true)
    {
        $return = false;
        if (!$this->getIsNewRecord()) {
            Yii::trace(get_class($this).'.restore()', 'awt.db.ar.CActiveRecordExtended');
            // start transaction
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($withRelated) {
                    foreach ($this->relations() as $name => $relation) {
                        // restore only HAS_MANY!
                        if ($relation[0] == self::HAS_MANY) {
                            $relationName = $name.'_with_deleted';
                            foreach ($this->$relationName as $relModel) {
                                $timeDiff = abs($relModel->modified - $this->modified);
                                // restore related only if the timestamp differs only few seconds!
                                if ($timeDiff<4) {
                                    $relModel->scenario = 'restore';
                                    if (!$relModel->restore()) {
                                        throw new Exception('Related model konnte nicht restored werden!');
                                    }
                                }
                            }
                        }
                    }
                }
                $this->is_deleted = 0;
                $this->scenario = 'restore';
                $return = $this->save();
                if (!$return) {
                    throw new Exception(get_class($this) . ' konnte nicht restored werden.');
                    //print_r($this->getErrors());
                }

                // commit transaction
                $transaction->commit();
            } catch (Exception $e) {
                // Eine Exception wird ausgelöst, falls eine Abfrage fehlschlägt
                // Alle Änderungen (auch nested) werden rückgängig gemacht.
                $transaction->rollBack();
                Yii::log('Exception: '.$e->getMessage(), CLogger::LEVEL_ERROR, 'CActiveRecordExtended');
            }

        } else {
            throw new CDbException(Yii::t('error', 'The active record cannot be restored because it is new'), 100002);
        }
        return $return;

    }

    /*
     * Alle Standardwerte setzten vor dem Validieren
     * - deleted
     * - created
     * - created_by
     * - modified
     * - modified_by
     *
     */
    protected function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->getIsNewRecord()) {
                // set deleted to 0
                $this->setAttribute('is_deleted', 0);

                if ($this->hasAttribute('created')) {
                    $this->created = time();
                }

                if ($this->hasAttribute('created_by')
                        && Yii::app()->getComponent('user')!=null
                        && Yii::app()->user->isGuest!=true) {
                    $this->created_by = Yii::app()->user->getId();
                }
            }

            if ($this->hasAttribute('modified')) {
                $this->setAttribute('modified', time());
            }

            if ($this->hasAttribute('modified_by')
                && Yii::app()->getComponent('user')!=null
                && Yii::app()->user->isGuest!=true) {
                // Set the current user as modifier
                $this->modified_by = Yii::app()->user->getId();
            } /*elseif ($this->modified_by != 0) {     // 0 = created by system
                // Set NULL as modifier, because update was done by the websync
                $this->modified_by = null;
            }*/
            return true;
        } else {
            return false;
        }
    }


    /*
     * SoftDelete
     * there are 3 scopes to use:
     * - default: gets all undeleted entries
     * - deleted: gets all deleted entries
     * - all: gets all entries
     */
    public function scopes()
    {
        return array(
            'default'=>array(
                  'condition'=>$this->getTableAlias(false, false).'.is_deleted=0',
            ),
            'deleted'=>array(
                  'condition'=>$this->getTableAlias(false, false).'.is_deleted=1',
            ),
            'all'=>array(
                  'condition'=>$this->getTableAlias(false, false).'.is_deleted=0 OR '.$this->getTableAlias(false, false).'.is_deleted=1',
            ),
        );
    }

    /*
     * SoftDelete condition must be checked before all find and count functions!
     */
    public function checkDeleteScopeInDBCriteria()
    {
        // is a condition set for soft delete?
        if (strpos($this->getDbCriteria()->condition, 'deleted') === false) {
            // no deleted is set in query, so set scope to default
            $scopes=$this->scopes();
            $this->getDbCriteria()->mergeWith($scopes['default']);
        }
    }

    /*
     * SoftDelete extension
     * anstatt beforeFind alle Find-Funktionen überschreiben!
     */
    public function findByPk($pk, $condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::findByPk($pk, $condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function find($condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::find($condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function findAll($condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::findAll($condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function findAllByAttributes($attributes, $condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::findAllByAttributes($attributes, $condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function findAllByPk($pk, $condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::findAllByPk($pk, $condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function findByAttributes($attributes, $condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::findByAttributes($attributes, $condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function count($condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::count($condition, $params);
    }

    /*
     * SoftDelete extension
     */
    public function countByAttributes($attributes, $condition = '', $params = array ( ))
    {
        $this->checkDeleteScopeInDBCriteria();
        return parent::count($attributes, $condition, $params);
    }

}
