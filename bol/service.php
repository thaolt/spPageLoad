<?php

/**
 *
 */
class SPPAGELOAD_BOL_Service
{
    const PLUGIN_NAME = 'sppageload';
    const BUILD_NUMBER = 1;
    protected static $classInstance = null;
    protected static $processors = null;
    private $jsIncluded = false;

    
    public static function getInstance() {
        if (null === self::$classInstance) {
            self::$classInstance = new self();
        }
        return self::$classInstance;
    }
    
    /**
     * ============= UTILITIES FUNCTIONS =============
     */
    public static function getPlugin() {
        return OW::getPluginManager()->getPlugin(self::PLUGIN_NAME);
    }
    
    public static function getJsUrl($filename) {
        return self::getPlugin()->getStaticJsUrl() . $filename . '.js';
    }
    
    public static function getCssUrl($filename) {
        return self::getPlugin()->getStaticCssUrl() . $filename . '.css';
    }
    
    public static function getRoute() {
        $route = OW::getRequestHandler()->getHandlerAttributes();
        if (is_array($route)) {
            return $route;
        }
        return false;
    }
    
    public static function isRoute($controller, $action = null) {
        $route = self::getRoute();
        
        if (!$route) return false;
        
        if ($route["controller"] == $controller) {
            if ($route["action"] == $action || !$action) {
                return true;
            }
        }
        
        return false;
    }

    public function requireSpPageLoadJs() {
    	OW::getDocument()->addScript(SPPAGELOAD_BOL_Service::getPlugin()->getStaticUrl() . 'js/jquery-scrollto.js?b'.self::BUILD_NUMBER);
    	OW::getDocument()->addScript(SPPAGELOAD_BOL_Service::getPlugin()->getStaticUrl() . 'js/jquery.history.js?b'.self::BUILD_NUMBER);
    	OW::getDocument()->addScript(SPPAGELOAD_BOL_Service::getPlugin()->getStaticUrl() . 'js/ajaxify-html5.js?b'.self::BUILD_NUMBER);
    	$this->jsIncluded = true;
    }

    public function spPageLoadFinalize() {
    	$this->requireSpPageLoadJs();
    	$html = OW::getDocument()->render();
        die($html);
    	// $matches = array();
     //    preg_match_all("#<title>(.+?)</title>#is", $html, $matches);
     //    $title = $matches[1][0];

    	// preg_match_all("#<div class=\"ow_page_wrap\">(.+?)</div>\s+<div class=\"ow_footer\">#is", $html, $matches);

    	// $body = $matches[1][0];

    	// $document = new ReflectionClass('OW_HtmlDocument');

     //    $prpPreIncludeJavaScriptDeclarations = $document->getProperty('preIncludeJavaScriptDeclarations');
     //    $prpPreIncludeJavaScriptDeclarations->setAccessible(true);
     //    $this->preIncludeJavaScriptDeclarations = $prpPreIncludeJavaScriptDeclarations->getValue(OW::getDocument());

     //    $jsPreData = '';

     //    // JS PRE INCLUDES HEAD DECLARATIONS
     //    ksort($this->preIncludeJavaScriptDeclarations);

     //    foreach ( $this->preIncludeJavaScriptDeclarations as $priority => $types )
     //    {
     //        foreach ( $types as $type => $declarations )
     //        {
     //            foreach ( $declarations as $declaration )
     //            {
     //                $attrs = array('type' => $type, "class"=>'jsPreInclude');
     //                $jsPreData .= UTIL_HtmlTag::generateTag('script', $attrs, true, PHP_EOL . $declaration . PHP_EOL) . PHP_EOL;
     //            }
     //        }
     //    }

     //    $prpStyleSheets = $document->getProperty('styleSheets');        
     //    $prpStyleSheets->setAccessible(true);
     //    $this->styleSheets = $prpStyleSheets->getValue(OW::getDocument());

     //    $cssData = '';

    	// // CSS FILE INCLUDES
     //    ksort($this->styleSheets['items']);

     //    foreach ( $this->styleSheets['items'] as $priority => $scipts )
     //    {
     //        foreach ( $scipts as $media => $urls )
     //        {
     //            foreach ( $urls as $url )
     //            {
     //                $attrs = array('rel' => 'stylesheet', 'type' => 'text/css', 'href' => $url, 'media' => $media);
     //                $cssData .= UTIL_HtmlTag::generateTag('link', $attrs) . PHP_EOL;
     //            }
     //        }
     //    }       

     //    $prpJavaScripts = $document->getProperty('javaScripts');
     //    $prpJavaScripts->setAccessible(true);
     //    $this->javaScripts = $prpJavaScripts->getValue(OW::getDocument());

     //    // JS FILE INCLUDES
     //    ksort($this->javaScripts['items']);
     //    $jsData = '';
     //    foreach ( $this->javaScripts['items'] as $priority => $types )
     //    {
     //        foreach ( $types as $type => $urls )
     //        {
     //            foreach ( $urls as $url )
     //            {
     //                $attrs = array('type' => $type, 'src' => $url);
     //                $jsData .= UTIL_HtmlTag::generateTag('script', $attrs, true) . PHP_EOL;
     //            }
     //        }
     //    }

     //    $prpOnloadJavaScripts = $document->getProperty('onloadJavaScript');
     //    $prpOnloadJavaScripts->setAccessible(true);
     //    $this->onloadJavaScript = $prpOnloadJavaScripts->getValue(OW::getDocument());

     //    // ONLOAD JS
     //    $onloadJsData = '';

     //    ksort($this->onloadJavaScript['items']);

     //    foreach ( $this->onloadJavaScript['items'] as $priority => $scripts )
     //    {
     //        foreach ( $scripts as $script )
     //        {
     //            $onloadJsData .= $script . PHP_EOL;
     //        }
     //    }

     //    $prpStyleDeclarations = $document->getProperty('styleDeclarations');
     //    $prpStyleDeclarations->setAccessible(true);
     //    $this->styleDeclarations = $prpStyleDeclarations->getValue(OW::getDocument());

     //    $cssHeadData = '';

     //    // CSS HEAD DECLARATIONS
     //    ksort($this->styleDeclarations['items']);

     //    foreach ( $this->styleDeclarations['items'] as $priority => $mediaTypes )
     //    {
     //        foreach ( $mediaTypes as $media => $declarations )
     //        {
     //            $attrs = array('media' => $media);
     //            $attrs = array('class' => 'cssHead');
     //            $cssHeadData .= UTIL_HtmlTag::generateTag('style', $attrs, true, implode(' ', $declarations));
     //        }
     //    }

    	// die('<realbody><title>'.$title.'</title>'.$cssHeadData.$body.$cssData.$jsData.
     //        $jsPreData.'<script class="onloadJs">'.$onloadJsData.'</script></realbody>');
    }
}
