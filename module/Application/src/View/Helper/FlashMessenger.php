<?php

namespace Application\View\Helper;

class FlashMessenger extends \Zend\View\Helper\FlashMessenger
{
    public function render($namespace = 'default', array $classes = [], $autoEscape = null)
    {
        if (!$this->getPluginFlashMessenger()->hasMessages($namespace)) {
            return '';
        }

        $alertClass = 'info';
        switch ($namespace) {
            case 'error' :
                $alertClass = 'danger';
                break;
            case 'success':
                $alertClass = 'success';
                break;
        }

        return sprintf('<div class="alert alert-%s">%s</div>', $alertClass, parent::render($namespace, $classes, $autoEscape));
    }
}