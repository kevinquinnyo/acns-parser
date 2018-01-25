<?php

namespace ACNS\Parser;

use ACNS\Parser\Engine\XML;
use ACNS\Parser\Engine\Echelon;

class Parser
{
	public $notice = null;

    protected $engines = [
        'ACNS\\Parser\\Engine\\XML',
        'ACNS\\Parser\\Engine\\Echelon',
    ];

	public function __construct(string $notice)
	{
		$this->notice = $notice;
	}

	public function parse(): \ACNS\Parser\Result
	{
		foreach ($this->engines as $engine) {

			$acns = new $engine($this->notice);
			$result = $acns->parse();

			if ($result->processed) {
				return $result;
			}
		}

		return \ACNS\Parser\Result::failure();
	}
}

