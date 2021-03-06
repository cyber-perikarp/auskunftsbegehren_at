<?php

namespace app\components;

use ArrayAccess;
use Yii;
use yii\di\Instance;
use yii\helpers\Html;
use yii\web\View as YiiView;

/**
 * View component rendering inline JS in separate file.
 */
class View extends YiiView
{
    const STORAGE_JS_HEAD = 'JSBlockHead';
    const STORAGE_JS_BEGIN = 'JSBlockBegin';
    const STORAGE_JS_END = 'JSBlockEnd';
    const STORAGE_JS_READY = 'JSBlockReady';
    const STORAGE_JS_LOAD = 'JSBlockLoad';
    const STORAGE_JS_AJAX = 'JSBlockAjax';

    /**
     * @var string|array|ArrayAccess storage component
     */
    public $storage = 'session';

    /**
     * Ensures storage component is set.
     */
    public function init()
    {
        parent::init();
        $this->storage = Instance::ensure($this->storage, '\ArrayAccess');
    }

    /**
     * Renders the content to be inserted in the head section.
     * The content is rendered using the registered meta tags, link tags, CSS/JS code blocks and files.
     * @return string the rendered content
     */
    protected function renderHeadHtml()
    {
        $lines = [];
        if (!empty($this->metaTags)) {
            $lines[] = implode("\n", $this->metaTags);
        }

        if (!empty($this->linkTags)) {
            $lines[] = implode("\n", $this->linkTags);
        }
        if (!empty($this->cssFiles)) {
            $lines[] = implode("\n", $this->cssFiles);
        }
        if (!empty($this->css)) {
            $lines[] = implode("\n", $this->css);
        }
        if (!empty($this->jsFiles[self::POS_HEAD])) {
            $lines[] = implode("\n", $this->jsFiles[self::POS_HEAD]);
        }
        if (!empty($this->js[self::POS_HEAD])) {
            $this->storage->offsetSet(self::STORAGE_JS_HEAD, $this->js[self::POS_HEAD]);
            $lines[] = Html::jsFile(['js/head', 'hash' => $this->hashKeys($this->js[self::POS_HEAD])]);
        }

        return empty($lines) ? '' : implode("\n", $lines);
    }

    /**
     * Renders the content to be inserted at the beginning of the body section.
     * The content is rendered using the registered JS code blocks and files.
     * @return string the rendered content
     */
    protected function renderBodyBeginHtml()
    {
        $lines = [];
        if (!empty($this->jsFiles[self::POS_BEGIN])) {
            $lines[] = implode("\n", $this->jsFiles[self::POS_BEGIN]);
        }
        if (!empty($this->js[self::POS_BEGIN])) {
            $this->storage->offsetSet(self::STORAGE_JS_BEGIN, $this->js[self::POS_BEGIN]);
            $lines[] = Html::jsFile(['js/begin', 'hash' => $this->hashKeys($this->js[self::POS_BEGIN])]);
        }

        return empty($lines) ? '' : implode("\n", $lines);
    }

    /**
     * Renders the content to be inserted at the end of the body section.
     * The content is rendered using the registered JS code blocks and files.
     * @param boolean $ajaxMode whether the view is rendering in AJAX mode.
     * If true, the JS scripts registered at [[POS_READY]] and [[POS_LOAD]] positions
     * will be rendered at the end of the view like normal scripts.
     * @return string the rendered content
     */
    protected function renderBodyEndHtml($ajaxMode)
    {
        $lines = [];

        if (!empty($this->jsFiles[self::POS_END])) {
            $lines[] = implode("\n", $this->jsFiles[self::POS_END]);
        }
        if ($ajaxMode) {
            $scripts = $this->getScripts();
            if (!empty($scripts)) {
                $this->storage->offsetSet(self::STORAGE_JS_AJAX, $scripts);
                $lines[] = Html::jsFile(['js/ajax', 'hash' => $this->hashKeys($scripts)]);
            }
        } else {
            if (!empty($this->js[self::POS_END])) {
                $this->storage->offsetSet(self::STORAGE_JS_END, $this->js[self::POS_END]);
                $lines[] = Html::jsFile(['js/end', 'hash' => $this->hashKeys($this->js[self::POS_END])]);
            }
            if (!empty($this->js[self::POS_READY])) {
                $this->storage->offsetSet(self::STORAGE_JS_READY, $this->js[self::POS_READY]);
                $lines[] = Html::jsFile(['js/ready', 'hash' => $this->hashKeys($this->js[self::POS_READY])]);
            }
            if (!empty($this->js[self::POS_LOAD])) {
                $this->storage->offsetSet(self::STORAGE_JS_LOAD, $this->js[self::POS_LOAD]);
                $lines[] = Html::jsFile(['js/load', 'hash' => $this->hashKeys($this->js[self::POS_LOAD])]);
            }
        }

        return empty($lines) ? '' : implode("\n", $lines);
    }

    private function getScripts() {
        $scripts = [];
        if (!empty($this->js[self::POS_END])) {
            $scripts = array_merge($scripts, $this->js[self::POS_END]);
        }
        if (!empty($this->js[self::POS_READY])) {
            $scripts = array_merge($scripts, $this->js[self::POS_READY]);
        }
        if (!empty($this->js[self::POS_LOAD])) {
            $scripts = array_merge($scripts, $this->js[self::POS_LOAD]);
        }
        return $scripts;
    }

    /**
     * Generates hash based on the JS keys.
     * @param array $js
     * @return string
     */
    public function hashKeys($js)
    {
        $keys = '';
        foreach (array_keys($js) as $key) {
            $keys .= $key;
        }
        return sprintf('%x', crc32($keys . Yii::getVersion()));
    }
}