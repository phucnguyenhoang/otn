const numPageToGet = 1;
const serverPath = 'http://iwork.com/luotbao/collect/';
const source = 'vnexpress';

var casper = require('casper').create({
	loadImages:  false,
	loadPlugins: false
}),
	utils = require('utils'),
	fs = require('fs');

var catLink;

casper.start(serverPath + 'get-source-cat-link/vnexpress', function() {
    catLink = JSON.parse(this.getPageContent());
    if (!catLink.error) {
    	catLink = catLink.data;
    }
});

casper.then(function() {
	var fs = require('fs');
	
	for (var category in catLink) {
		if (catLink[category] != '') {
			for (var i=1; i<=numPageToGet; i++) {
				casper.thenOpen(catLink[category] + '/page/' + i + '.html?cat=' + category, function(res) {
					var catURL = res.url,
						cat = catURL.substr(catURL.lastIndexOf('=') + 1, catURL.length - catURL.lastIndexOf('=') - 1);

					var cats = this.evaluate(function(cat, source) {
						var data = [],
							images = [],
							topCat = $('#box_show_item_top');

						// get top main category
						if (topCat.length > 0) {
							var catObj = {},
								link = topCat.find('.box_show_item_main').find('.box_show_item_title').find('a'),
								href = link.attr('href'),
								image = topCat.find('.box_show_item_main').find('img').attr('src');
							catObj.cat = cat;
							catObj.alias = href.substr(href.lastIndexOf('/') + 1, href.length - href.lastIndexOf('/') - 6);
							catObj.link = href;
							catObj.title = link.text();
							catObj.description = '';
							catObj.thumb = image.substr(image.lastIndexOf('/') + 1, image.length - image.lastIndexOf('/') - 1);
							catObj.view = '';
							catObj.comment = '';
							catObj.type = 'article';
							catObj.source = source;
							catObj.get_content = false;
							data.push(catObj);
							images.push(image);

							// get top sub category
							topCat.find('.item_box_show').each(function() {
								var item = $(this),
									catObj = {},
									link = item.find('.box_show_item_title').find('a'),
									href = link.attr('href'),
									image = item.find('img').attr('src');

								catObj.cat = cat;
								catObj.alias = href.substr(href.lastIndexOf('/') + 1, href.length - href.lastIndexOf('/') - 6);
								catObj.link = href;
								catObj.title = link.text();
								catObj.description = '';
								catObj.thumb = image.substr(image.lastIndexOf('/') + 1, image.length - image.lastIndexOf('/') - 1);
								catObj.view = '';
								catObj.comment = '';
								catObj.type = 'article';
								catObj.source = source;
								catObj.get_content = false;
								data.push(catObj);
								images.push(image);
							});
						} else if ($('#box_news_top').length > 0) {
							topCat = $('#box_news_top');
							var catObj = {},
								link = topCat.find('.box_hot_news').find('.title_news').find('a'),
								href = link.attr('href'),
								image = topCat.find('.box_hot_news').find('.block_news_big').find('img').attr('src');
							catObj.cat = cat;
							catObj.alias = href.substr(href.lastIndexOf('/') + 1, href.length - href.lastIndexOf('/') - 6);
							catObj.link = href;
							catObj.title = link.text();
							catObj.description = topCat.find('.box_hot_news').find('.news_lead').text();
							catObj.thumb = image.substr(image.lastIndexOf('/') + 1, image.length - image.lastIndexOf('/') - 1);
							catObj.view = '';
							catObj.comment = '';
							catObj.type = 'article';
							catObj.source = source;
							catObj.get_content = false;
							data.push(catObj);
							images.push(image);

							// get top sub category
							topCat.find('.box_sub_hot_news').find('li').each(function() {
								var item = $(this),
									catObj = {},
									link = item.find('.title_news').find('a'),
									href = link.attr('href'),
									des = item.find('.news_lead');

								catObj.cat = cat;
								catObj.alias = href.substr(href.lastIndexOf('/') + 1, href.length - href.lastIndexOf('/') - 6);
								catObj.link = href;
								catObj.title = link.text();
								catObj.description = des.text();
								catObj.thumb = '';
								catObj.view = '';
								catObj.comment = item.find('.txt_num_comment').text();
								catObj.type = 'article';
								catObj.source = source;
								catObj.get_content = false;
								data.push(catObj);
							});
						}
						
						// get middle category
						$('ul#news_home > li').each(function() {
							var item = $(this),
								catObj = {},
								link = item.find('.title_news').find('a.txt_link'),
								href = link.attr('href'),
								image = item.find('.thumb').find('img').attr('src');

							catObj.cat = cat;
							catObj.alias = href.substr(href.lastIndexOf('/') + 1, href.length - href.lastIndexOf('/') - 6);
							catObj.link = href;
							catObj.title = link.text();
							catObj.description = item.find('.news_lead').text();
							catObj.thumb = image.substr(image.lastIndexOf('/') + 1, image.length - image.lastIndexOf('/') - 1);
							catObj.view = '';
							catObj.comment = item.find('.title_news').find('.txt_num_comment').find('.total').text();
							catObj.type = 'article';
							catObj.source = source;
							catObj.get_content = false;
							data.push(catObj);
							images.push(image);
						});					

						return {data: data, images: images};
					}, cat, source);

					// get images
					if (typeof(cats) === 'object') {
						var jsonImage = {
							cat: cat,
							images: cats.images
						};
						fs.write('../../resources/json/images.json', JSON.stringify(jsonImage), 'w');
						fs.write('../../resources/json/category.json', JSON.stringify(cats.data), 'w');
						
						this.open(serverPath + 'download');
						this.open(serverPath + 'category');

						// get article
						var articles = cats.data;
						for (var num=0; num<articles.length; num++) {
							var article = articles[num],
								articleLink = article.link;

							casper.thenOpen(articleLink + '?cat=' + cat, function(res) {
								var catURL = res.url,
									cat = catURL.substr(catURL.lastIndexOf('=') + 1, catURL.length - catURL.lastIndexOf('=') - 1),
									alias = catURL.substr(catURL.lastIndexOf('/') + 1, catURL.lastIndexOf('.') - catURL.lastIndexOf('/') - 1);

								var articleData = this.evaluate(function(cat, source, alias, thumb) {
									var result = {},
										boxDetail = $('#box_details_news');

									result.thumb = thumb;

									if (boxDetail.length) {
										result.alias = alias;
										result.title = boxDetail.find('.title_news').text();
										result.description = boxDetail.find('.short_intro').text();
										result.date = boxDetail.find('.block_timer').first().text();
										var tags = [];
										boxDetail.find('.block_tag').find('a.tag_item').each(function() {
											var tag = $(this).text();

											tags.push({alias: tag.replace(' ', '-'), name: tag});
										});
										result.tag = tags;
										result.category = cat;
										var content = '';
										if (boxDetail.find('.fck_detail').length) {
											content = boxDetail.find('.fck_detail').html();
										} else if (boxDetail.find('#article_content').length) {
											content = boxDetail.find('#article_content').html();
										}
										result.content = content;
										result.num_comment = boxDetail.find('#total_comment').text();
										var comments = [];
										$('#list_comment > .comment_item').each(function() {
											var item = $(this),
												comment = {},
												subComment = [];

											comment.owner = {id: '', name: item.find('.width_comment_item > .width_common > .user_status > .left').text()}
											comment.content = item.find('.width_comment_item > .width_common > p').first().text();
											comment.date = '';
											item.find('.sub_comment').find('.subcomment_item').each(function() {
												var subItem = $(this),
													feedback = {};
												feedback.owner = {id: '', name: subItem.find('.user_status > .left').text()};
												feedback.content = subItem.find('p').first().text();
												feedback.date = '';

												subComment.push(feedback);
											});
											comment.feedback = subComment;
											comments.push(comment);
										});
										result.comments = comments;
										result.type = 'article';
										result.source = source;
									} else if ($('#video_top').length) {
										var boxDetail = $('#video_top');

										result.alias = alias;
										result.title = boxDetail.find('.video_top_title a').text();
										result.description = boxDetail.find('#video_top_more').text();
										result.date = boxDetail.find('.video_post_time').text();
										var tags = [];
										boxDetail.find('.tag_video').find('a.eachTag_video').each(function() {
											var tag = $(this).text();

											tags.push({alias: tag.replace(' ', '-'), name: tag});
										});
										result.tag = tags;
										result.category = cat;
										result.content = $('.video_big_top').html();

										var comments = [];
										$('#comment_video .comment_item').each(function() {
											var item = $(this),
												comment = {},
												subComment = [];

											comment.owner = {id: '', name: item.find('.width_comment_item > .width_common > .user_status > .left').text()}
											comment.content = item.find('.width_comment_item > .width_common > p').first().text();
											comment.date = '';
											item.find('.sub_comment').find('.subcomment_item').each(function() {
												var subItem = $(this),
													feedback = {};
												feedback.owner = {id: '', name: subItem.find('.user_status > .left').text()};
												feedback.content = subItem.find('p').first().text();
												feedback.date = '';

												subComment.push(feedback);
											});
											comment.feedback = subComment;
											comments.push(comment);
										});
										result.comments = comments;
										result.type = 'video';
										result.source = source;
									}
									

									return result;
								}, cat, source, alias, article['thumb']);

								if (articleData) {
									utils.dump(articleData);
									fs.write('../../resources/json/article.json', JSON.stringify(articleData), 'w');
									
									this.open(serverPath + 'article');
								}
							});
						}
					}
				});
			}			
		}
	}
});

casper.run();