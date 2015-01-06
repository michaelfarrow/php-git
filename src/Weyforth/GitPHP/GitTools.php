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

	protected $root = ABSPATH;

	public function __construct($path){
		$this->root = $path;
	}

	public function setRootPath($path){
		$this->root = $path;
	}

	public function currentCommit($branch = null) {
		if(!$branch) $branch = $this->currentBranch();

		if ( $hash = @file($this->root . '/.git/refs/heads/' . $branch)) {
			return $hash[0];
		} else {
			if ( $hash = @file($this->root . '/REVISION')){
				return $hash[0];
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
