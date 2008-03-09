<?php
class Article extends AppModel {

	var $name = 'Article';

	var $belongsTo = array(
			'Channel' =>
				array('className' => 'Channel',
						'foreignKey' => 'channel_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Webpage' =>
				array('className' => 'Webpage',
						'foreignKey' => 'webpage_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasAndBelongsToMany = array(
			'Tag' =>
				array('className' => 'Tag',
						'joinTable' => 'articles_tags',
						'foreignKey' => 'article_id',
						'associationForeignKey' => 'tag_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	
	//通过频道查询最新N条数据
	function findArticleByChannel($channel_id = null,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Article.channel_id = $channel_id order by Article.created desc limit $limit");
	}
	
	//通过频道查询点击量最大·热门N条数据
	function findArticleByChannelClick($channel_id = null,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Article.channel_id = $channel_id order by Article.hits desc limit $limit");
	}

	//通过栏目查询最新N条数据
	function findArticleByWebpage($webpage_id = null,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Article.webpage_id = $webpage_id order by Article.created desc limit $limit");
	}

	//通过栏目查询最大·热门N条数据
	function findArticleByWebpageClick($webpage_id = null,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Article.webpage_id = $webpage_id order by Article.hits desc limit $limit");
	}

	//取出图片
	function findMerchant($channel_id = null,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Article.channel_id = $channel_id 
		          and Article.elite = 1 
				  and Article.default_pic_url is not null
				  order by Article.created desc limit $limit");
	}
}
?>