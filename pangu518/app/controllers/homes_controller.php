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

	var $N_ZXXX = 1001; //最新消息
	var $N_ZXRM = 1001; //最新热门
	var $N_GSXX = 6; //公司信息
	var $N_SCXX = 7; //市场信息
	var $N_JJKX = 8; //经济快讯
	var $N_FHXX = 9; //分红信息

	function news_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->N_ZXXX,5)); //最新消息
		$this->set('zxrms', $this->Article->findArticleByChannelClick($this->N_ZXRM,5)); //最新消息
		$this->set('gsxxs', $this->Article->findArticleByWebpage($this->N_GSXX,5)); //公司信息;
		$this->set('scxxs', $this->Article->findArticleByWebpage($this->N_SCXX,5)); //市场信息;
		$this->set('jjkxs', $this->Article->findArticleByWebpage($this->N_JJKX,5)); //公司信息;
		$this->set('fhxxs', $this->Article->findArticleByWebpage($this->N_FHXX,5)); //分红信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,4)); //商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	var $CM_ZXXX = 1002; //最新消息
	var $CM_RMTJ = 1002; //热门推荐
	var $CM_SCYY = 10; //市场运营
	var $CM_YYXZ = 29; //运营细则


	function consumer_market_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->CM_ZXXX,5)); //最新消息
		$this->set('rmtjs', $this->Article->findArticleByWebpageClick($this->CM_RMTJ,5)); //热门推荐;
		$this->set('scyys', $this->Article->findArticleByWebpage($this->CM_SCYY,5)); //市场运营;
		$this->set('yyxzs', $this->Article->findArticleByWebpage($this->CM_YYXZ,5)); //运营细则;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,4)); //商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	function merchants_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,5)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	function workstations_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,9)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	function cs_center_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,9)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	function legal_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,9)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}



	function fortune_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,9)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}

	function cooperation_index() {
		$this->layout = 'website';
		$this->set('zxxxs', $this->Article->findArticleByChannel($this->ZXXX,9)); //最新消息
		$this->set('cfzxs', $this->Article->findArticleByWebpage($this->CFZX,6)); //财富资讯;
		$this->set('xfscs', $this->Article->findArticleByWebpage($this->XFSC,6)); //消费市场;
		$this->set('mypgs', $this->Article->findArticleByWebpage($this->MYPG,7)); //我与消费财富网;
		$this->set('sjxxs', $this->Article->findArticleByChannel($this->SJXX,7)); //商家信息;

		$this->set('merchants', $this->Article->findMerchant($this->SJXX,7)); //首页商家滚动图片

		$this->set('lotterites', $this->Lottery->findBulletin(4)); //开奖公告
	}
}
?>