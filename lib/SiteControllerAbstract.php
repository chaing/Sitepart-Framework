<?php
/**
 * base web controller abstract
 * 
 * added by chaing 2010-04-15
 *
 */
 
abstract class SiteControllerAbstract extends Zend_Controller_Action
{
    //过滤
    protected $_filter = null;
    
    //语言
    protected $_lang = 'zh_CN';
    
    //默认验证
    public $_verification = FALSE;
    
    protected $session = null;
    
    //muti language
    private $_siteLang = '';
    
    public function init()
    {
        //parent::init();

        $this->smarty = Zend_Registry::get('smarty');
        $this->config = Zend_Registry::get('config');
        $this->session = new Zend_Session_Namespace('IMS');
        $this->params = $this->_request->getParams();
        
        $this->_moduleName      = $this->_request->getModuleName();
        $this->_controllerName  = $this->_request->getControllerName();
        $this->_actionName      = $this->_request->getActionName();
        //$this->_baseUrl         = $this->_request->getBaseUrl();
        $this->_baseUrl         = $this->config->site->siteUrl;
        $this->_requesturi      = $this->_request->getRequestUri();
        $this->_clientIP        = $this->_request->getClientIp();
        
        if ($this->session->userInfo) {
            $this->smarty->assign('userInfo', $this->session->userInfo);
        }
        
        //站点名称,开发小组:
        $this->smarty->assign('sitename', $this->config->site->siteName);
        $this->smarty->assign('sitedev', $this->config->site->siteDev);


    }
    
    /**
     * 过滤
     *
     *
     */
    protected function _getFilterChainInstance()
    {
		if ($this->_filter == NULL) {
			$this->_filter = new Zend_Filter();
            $this->_filter->addFilter(new Zend_Filter_StringTrim())
                          ->addFilter(new Zend_Filter_StripTags());

		}
		return $this->_filter;
    }

    /**
     *  貌似没用
     *
     */
    function __call($action, $arguments)
    {
        return $this->__call($action, $arguments);
        //$this->smarty->display( 'error.html' );
    }
    
}