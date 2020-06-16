/*

	By：小鑫
	Date：2019.3.28
	Qq：857525554
	
 */
var xScroll=function(el){xScroll.prototype.init(el)};xScroll.prototype={init:function(_el){this.start(_el);$(window).on('scroll',function(){xScroll.prototype.start(_el);console.log($(window).scrollTop())})},start:function(_el){$(_el).each(function(){var _self=$(this);var xScrollTop=$(window).scrollTop();var isWindowHeiget=$(window).height()*0.8;var _class=$(this).data('animation');if(xScrollTop+isWindowHeiget>$(this).offset().top){_self.addClass(_class);_self.css({"visibility":"visible"})}})}};$.fn.extend({xScroll:function(config){console.log($(this));$(this).each(function(){$(this).addClass("animated");$(this).css({"visibility":"hidden"});new xScroll($(this))})}})