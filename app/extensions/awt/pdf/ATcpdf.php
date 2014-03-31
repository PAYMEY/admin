<?php

require_once(dirname(__FILE__).'/tcpdf/config/tcpdf_config.php');
require_once(dirname(__FILE__).'/tcpdf/tcpdf.php');
 
class ATcpdf extends TCPDF {

    /**
     *
     * @protected
     */
    protected $footer_text1;
    protected $footer_text2;
    protected $footer_text3;
    protected $footer_text4;

    protected $footer_image;
    protected $footer_x;
    protected $footer_y;
    protected $footer_w;
    protected $footer_h;

    private $showFooter = false;
    private $showImage = true;

    /**
     *
     */
    public function __construct($orientation, $unit, $format, $unicode, $encoding)
    {
        define("K_PATH_CACHE", Yii::app()->getRuntimePath());
        parent::__construct($orientation, $unit, $format, $unicode, $encoding);
    }

    /*
     *
     */
    public function checkBreak($h, $y, $addpage = true)
    {
        return $this->checkPageBreak($h, $y, $addpage);
    }

    /**
     *
     */
    public function setFooterImage($image, $x, $y, $w, $h)
    {
        $this->showFooter = false;
        $this->showImage = true;
        $this->footer_image = $image;
        $this->footer_x = $x;
        $this->footer_y = $y;
        $this->footer_w = $w;
        $this->footer_h = $h;
    }

    /*
     *
     */
    public function Header()
    {

    }

    /*
     *
     */
    public function Footer()
    {
        if ($this->showImage) {
            //$this->SetXY($this->footer_x, $this->footer_y);
            //$this->Image($this->footer_image, $this->footer_x, $this->footer_y, $this->footer_w, $this->footer_h);
            //$this->SetXY(0, 0);
            //$this->ImageSVG($this->footer_image, 0, 0, 210, 297, '', 'T', '', 0, $fitonpage=false);
            //$this->ImageSVG($this->footer_image, 0, 0, 211, 298, '', '', '', 0, true);
            $this->ImageSVG($this->footer_image, 1, 1, 210, 297);
        }
    }

}

