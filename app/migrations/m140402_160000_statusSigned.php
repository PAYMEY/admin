<?php

class m140402_160000_statusSigned extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('users', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('paymey_accounts', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('admin_users', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('affiliate_history', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('currencies', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('transaction_details', 'status', 'tinyint(3) default \'0\'');
        echo "done.\n";
        return true;
    }

    public function down()
    {
        $this->alterColumn('users', 'status', 'tinyint(3) unsigned default \'0\'');
        $this->alterColumn('paymey_accounts', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('admin_users', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('affiliate_history', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('currencies', 'status', 'tinyint(3) default \'0\'');
        $this->alterColumn('transaction_details', 'status', 'tinyint(3) default \'0\'');
        echo "done.\n";
        return true;
    }

}