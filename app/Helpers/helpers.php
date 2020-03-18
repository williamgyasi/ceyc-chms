<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function applClasses()
    {
        $data = config('custom.custom');
        $layoutClasses = [
            'theme' => $data['theme'],
            'sidebarCollapsed' => $data['sidebarCollapsed'],
            'navbarColor' => $data['navbarColor'],
            'navbarType' => $data['navbarType'],
            'footerType' => $data['footerType'],
            'sidebarClass' => 'menu-expanded',
            'bodyClass' => $data['bodyClass']
        ];

                
        
        //Theme
        if($layoutClasses['theme'] == 'dark')
            $layoutClasses['theme'] = "dark-layout";
        elseif($layoutClasses['theme'] == 'semi-dark')
            $layoutClasses['theme'] = "semi-dark-layout";
        else
            $layoutClasses['theme'] = "";

        //navbar
        switch($layoutClasses['navbarType']){
            case "static":
                $layoutClasses['navbarType'] = "navbar-static";
                break;
            case "sticky":
                $layoutClasses['navbarType'] = "navbar-sticky";
                break;
            case "hidden":
                $layoutClasses['navbarType'] = "navbar-hidden";
                break;
            default:
                $layoutClasses['navbarType'] = "navbar-floating";
        }

        // sidebar Collapsed
        if($layoutClasses['sidebarCollapsed'] == 'true')
            $layoutClasses['sidebarClass'] = "menu-collapsed";

        //footer
        switch($layoutClasses['footerType']){
            case "sticky":
                $layoutClasses['footerType'] = "fixed-footer";
                break;
            case "hidden":
                $layoutClasses['footerType'] = "footer-hidden";
                break;
            default:
                $layoutClasses['footerType'] = "footer-static";
        }

        return $layoutClasses;
    }
}