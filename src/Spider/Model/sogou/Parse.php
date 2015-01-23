<?php

namespace Spider\Model\Sogou;

use Sys\Mongo\Collection;
use Sys\Validate;
use Sys\Filter;
use Spider\Model\sogou\Fetch;
use Spider\Model\sogou\Keyword;

class Parse {
	protected $colContent;
	protected $colData;
	protected $mFetch;
	public function __construct() {
		$this->colContent = new Collection ( 'spider.sogou.content' );
		$this->colData = new Collection ( 'spider.sogou.data' );
		$this->mFetch = new Fetch ();
		$this->mKeyword = new Keyword ();
	}
	public function run() {
		$row = $this->colContent->findOne ( array (
				'isFetch' => true,
				'isParse' => false 
		) );
		if ($row) {
			$content = trim ( $row ['content'] );
			$content = substr ( $content, 10, - 2 );
			
			$data = json_decode ( $content, true );
			$list = $data ['result'] [0] ['srrs'];
			
			if ($list) {
				
				try {
					
					foreach ( $list as $item ) {
						$this->parseItem ( $item, $row );
					}
					
					$row ['isParse'] = true;
					$row ['parseTime'] = time ();
					$this->colContent->save ( $row );
					
					// 添加下一页任务,为数据范围宽度，限制采集页数
					$nextPage = $row ['page'] + 1;
					if ($nextPage < 6) {
						$this->mFetch->insert ( $row ['keyword'], $nextPage);
					}
					
				} catch ( \MongoException $e ) {
					throw $e;
				}
			} else {
				$this->colContent->remove ( $row );
			}
		}
	}
	
	/**
	 * 分析处理单条职位数据
	 */
	public function parseItem($item, $row) {
		$title = $item ['title'];
		
		foreach ( $this->splitWord ( $title ) as $keyword ) {
			$this->mKeyword->add($keyword);
		}

		$this->colData->insert ( array (
				'contentId' => $row ['_id'],
				'data' => $item,
				'isUpdate' => false,
				'insertTime' => time () 
		) );
	}
	public function splitWord($text) {
		$sh = scws_open ();
		scws_send_text ( $sh, $text );
		$list = scws_get_words ( $sh, 'n' );
		scws_close ( $sh );
		$words = array ();
		foreach ( $list as $item ) {
			$item = $item['word'];
			if (mb_strlen ( $item ) > 1) {
				$words [] = $item;
			}
		}
		return $words;
	}
}