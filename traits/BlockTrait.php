<?php

namespace dench\block\traits;

trait BlockTrait
{
    public function render($view, $params = [])
    {
        $content = parent::render($view, $params);

        if (preg_match_all('/\{[0-9a-zA-Z_\-]+?\}/', $content, $matches)) {
            foreach ($matches[0] as $match) {
                $content = preg_replace('/' . $match . '/', '***', $content);
            }
        }

        return $content;
    }
}