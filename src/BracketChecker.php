<?php

namespace Studypet\Tools {

    class BracketChecker
    {
        protected $expression;
        private const ALLOWED_CHARS = ["(", ")", " ", "\n", "\t", "\r"];

        function __construct($expression)
        {
            $this->expression = $expression;
        }

        static function check($expression = null)
        {
            $stack = [];
            $expressionArray = str_split($expression);
            foreach ($expressionArray as $index => $item) {
                if (!in_array($item, self::ALLOWED_CHARS)) {
                    $index++;
                    throw new \InvalidArgumentException("Illegal character '{$item}' [position: {$index}] in expression!");
                }
                if ($item === '(') {
                    array_push($stack, $item);
                }
                if ($item === ')') {
                    $res = array_pop($stack);
                    if(!$res) {
                        return false;
                    }
                }
            }
            if (count($stack) > 0) {
                return false;
            }
            return true;
        }
    }
}
