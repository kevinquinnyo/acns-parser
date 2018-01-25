<?php
namespace ACNS\Parser\Engine;

abstract class AbstractEngine
{
	abstract public function parse(): \ACNS\Parser\Result;
}

