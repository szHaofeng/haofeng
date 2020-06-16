$(function(){
	
	$("#izl_rmenu2").each(function(){
		$(this).find(".btn2-wx").mouseenter(function(){
			$(this).find(".pic2").fadeIn("fast");
		});
		$(this).find(".btn2-wx").mouseleave(function(){
			$(this).find(".pic2").fadeOut("fast");
		});
		$(this).find(".btn2-phone").mouseenter(function(){
			$(this).find(".phone2").fadeIn("fast");
		});
		$(this).find(".btn2-phone").mouseleave(function(){
			$(this).find(".phone2").fadeOut("fast");
		});
		$(this).find(".btn2-top").click(function(){
			$("html, body").animate({
				"scroll-top":0
			},"fast");
		});
	});
	var lastRmenuStatus=false;
	
});
(function ($) {
				 /*banner*/
		       	var mySwiper = new Swiper('.swiper-container', {
					pagination: '.pagination',
					paginationClickable: true,
					autoplay: 5000,
					speed: 1,
					loop:true,
			
					onInit: function(swiper) { 
						swiperAnimateCache(swiper); //隐藏动画元素 
						swiperAnimate(swiper); //初始化完成开始动画
					},
					onSlideChangeEnd: function(swiper) {
						swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
					}
				});
			})(jQuery);
			/*banner消息*/
			function Scroll(){}
			Scroll.prototype.upScroll=function(dom,_h,interval){var dom=document.getElementById(dom);var timer=setTimeout(function(){var _field=dom.firstElementChild;_field.style.marginTop=_h;clearTimeout(timer);},1000)
			setInterval(function(){var _field=dom.firstElementChild;_field.style.marginTop="0px";dom.appendChild(_field);var _field=dom.firstElementChild
			_field.style.marginTop=_h;},interval)}
			var myScroll=new Scroll();
			/*这是启动方式*/
			/*
			 * demo 父容器(ul)的id
			 * -36px 子元素li的高度
			 * 3000  滚动间隔时间
			 * 每次滚动持续时间可到css文件中修改
			 */
			myScroll.upScroll("news_roll","-40px",3000);
			
			/*数字滚动*/
			$(".value_num_1").numberRock({
		    speed:20,//
		    count:6000//
			})
			$(".value_num_2").numberRock({
		    speed:20,
		    count:11000
			})
			$(".value_num_3").numberRock({
		    speed:10,
		    count:2377
			})
			$(".value_num_4").numberRock({
		    speed:10,
		    count:1396
			})
			$(".value_num_5").numberRock({
		    speed:10,
		    count:15000
			});
			
			/*页面滚动*/
			$(".xScroll").xScroll();
			
			/*联盟媒体*/
			
			$(function(){	
				$('.alliance_media_table li').click(function(){
					$(this).addClass('active').siblings().removeClass('active');
					$('.alliance_media_logo>ul:eq('+$(this).index()+')').fadeIn("slow").siblings().fadeOut(100);	
				})
			});
			
			$(function(){	
				$('.usage_flow_tab ul li').click(function(){
					$(this).addClass('active').siblings().removeClass('active');
					$('.usage_flow_box>ul:eq('+$(this).index()+')').fadeIn("slow").siblings().fadeOut(100);	
				})
			});
			
			
				jQuery(".consensus_academy_box").slide({
					mainCell: ".consensus_academy_box_con ul",
					autoPlay: false,
					titCell: ".consensus_academy_box_tab span",
					trigger: "click",
					effect: "left"
				});