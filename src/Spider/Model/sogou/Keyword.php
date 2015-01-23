<?php

namespace Spider\Model\sogou;

use Sys\Mongo\Collection;

class Keyword {
	protected $colKeyword;
	protected $mFetch;
	public function __construct() {
		$this->colKeyword = new Collection ( 'spider.sogou.keyword' );
		$this->mFetch = new Fetch ();
		$this->colKeyword->ensureIndex ( array (
				'keyword' => 1 
		), array (
				"unique" => true 
		) );
	}
	
	/**
	 * 添加关键词
	 *
	 * 如果关键词已存在，则返回False
	 * 如果添加成功，新建该关键词的采集网址任务
	 */
	public function add($keyword) {
		$row = $this->colKeyword->findOne ( array (
				'keyword' => $keyword 
		) );
		if ($row) {
			return false;
		} else {
			$this->colKeyword->insert ( array (
					'keyword' => $keyword,
					'insertTime' => time()
			) );
			$this->mFetch->insert ( $keyword, 1 );
		}
	}
	
	/**
	 * 更新关键词采集数据
	 *
	 * 清除该关键词的所有采集任务
	 */
	public function update($keyword) {
	}
	
	/**
	 * 更新所有关键词
	 */
	public function updateAll() {
	}
}