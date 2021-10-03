<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/02/2018
 * Time: 19:41
 */

namespace AppBundle\Command;


class ExportDocumentsCommand {

    private $name;

    private $content;

    /**
     * FormatConverterCommand constructor.
     *
     * @param $name
     * @param $content
     */
    public function __construct($name, $content) {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getContent() {
        return $this->content;
    }
}