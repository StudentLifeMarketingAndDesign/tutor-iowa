<?php
//MemberDecorator is not used on the current site

class MemberExtension extends DataExtension {

    private static $belongs_many_many = array(
        "HelpLabs" => "HelpLab"
    );

}

