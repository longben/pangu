<?php 
class HomesController extends AppController {
	var $helpers = array('Html');
    var $uses = array('Article','Lottery');

	var $ZXXX = 1001; //最新消息
	var $CFZX = 8; //财富资讯
	var $XFSC = 10; //消费市场
	var $MYPG = 999; //我与消费财富网
	var $SJXX = 1004; //商家信息

	function index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,9)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	function index_image() {
		$this->layout = 'xml';
		$this->set('images', $this->Article->findMerchant($this->SJXX,5)); //首页Flash滚动图片
	}

}
?>