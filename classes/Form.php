<?php
/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 14/03/2018
 * Time: 13:58
 */

class Form
{

    public static function open($args = false)
    {
        $settings = array("method" => "post", "action" => "#");
        if ($args) $settings = array_merge($settings, $args);
        $attr = "";
        foreach ($settings as $key => $value)
        {
            $attr .= " " . $key . "='" . $value . "'";
        }
        echo "<form$attr>";
    }

    public static function input($name, $args = false)
    {
        $settings = array('type' => 'text', 'name' => $name, 'id' => $name);

        if ($args) $settings = array_merge($settings, $args);
        $attr = "";
        foreach ($settings as $key => $value)
        {
            $attr .= " " . $key . "='" . $value . "'";
        }

        echo "<input$attr />";
    }

    public static function textarea($name, $value = null, $args = false) {
        $settings = array('name' => $name, 'id' => $name);
        if ($args) $settings = array_merge($settings, $args);
        $attr = "";
        foreach ($settings as $key => $val)
        {
            $attr .= " " . $key . "='" . $val . "'";
        }
        echo "<textarea$attr>$value</textarea>";
    }

    public static function label($name, $value = null, $args = false) {
        $settings = array('for' => $name);
        if ($args) $settings = array_merge($settings, $args);
        $attr = "";
        foreach ($settings as $key => $val)
        {
            $attr .= " " . $key . "='" . $val . "'";
        }
        echo "<label$attr>$value</label>";
    }

    public static function close()
    {
        echo "</form>";
    }

    public static function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}