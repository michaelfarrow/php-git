<?php
/**
 * Git PHP.
 *
 * Git tools for PHP.
 *
 * @author    Mike Farrow <contact@mikefarrow.co.uk>
 * @license   Proprietary/Closed Source
 * @copyright Mike Farrow
 */

namespace Weyforth\GitPHP;

class GitTools{

	protected $root;

	public function __construct($path = false){
		$this->root = $path ? $path : dirname(__FILE__);
	}

	public function setRootPath($path){
		$this->root = $path;
	}

	public function currentCommit($branch = null) {
		if(!$branch) $branch = $this->currentBranch();

		if ( $hash = @file($this->root . '/.git/refs/heads/' . $branch)) {
			return trim($hash[0]);
		} else {
			if ( $hash = @file($this->root . '/REVISION')){
				return trim($hash[0]);
			}else{
				return false;
			}
		}
	}

	public function currentBranch() {
		$stringfromfile = @file($this->root . '/.git/HEAD' );

		if(!$stringfromfile) return '';

		$firstLine = $stringfromfile[0];
		$explodedstring = explode("/", $firstLine, 3);
		$branchname = $explodedstring[2];

		return trim($branchname);
	}

}
