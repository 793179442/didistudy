/*
	
	手机端字母索引城选择插件
*/
var provinces = {
	    "A": ["鞍山","安阳","安庆","安康","澳门","阿克苏","阿拉尔","阿里","阿坝"],
	    "B": ["北京","保定","包头","滨州","宝鸡","蚌埠","本溪","白城","亳州"],
	    "C": ["成都","长沙","重庆","长春","常州","沧州","常德","郴州","赤峰"],
	    "D": ["东莞","大连","德州","东营","大庆","丹东","大同","大理","定州"],
	    "E": ["鄂尔多斯","恩施","鄂州"],
	    "F": ["福州","佛山","抚顺","阜阳","阜新","抚州","防城港"],
	    "G": ["广州","贵阳","桂林","贵港","固原","赣州","馆陶","广安","广元"],
	    "H": ["杭州","哈尔滨","海口","合肥","呼和浩特","惠州","衡阳","邯郸","湖州"],
	    "J": ["济南","济宁","嘉兴","江门","金华","吉林","揭阳","九江","焦作"],
	    "K": ["昆明","克拉玛依","开封","喀什","克孜勒苏","垦利"],
	    "L": ["兰州","洛阳","廊坊","临沂","聊城","连云港","吕梁","乐山","辽阳"],
	    "M": ["绵阳","茂名","马鞍山","牡丹江","明港","梅州","眉山"],
	    "N": ["南京","南昌","宁波","南宁","南阳","南通","内江","宁德","南充"],
	    "P": ["平顶山","盘锦","萍乡","平凉","濮阳","攀枝花","莆田","普洱","邳州"],
	    "Q": ["青岛","泉州","秦皇岛","其他","齐齐哈尔","衢州","清远","钦州","曲靖"],
	    "R": ["日照","日喀则","瑞安","如皋","如东"],
	    "S": ["上海","深圳","苏州","沈阳","石家庄","汕头","宿州","绍兴","十堰"],
	    "T": ["天津","太原","唐山","泰安","台州","泰州","台湾","铁岭","天水"],
	    "W": ["武汉","无锡","潍坊","乌鲁木齐","温州","威海","芜湖","梧州","瓦房店"],
	    "X": ["西安","厦门","徐州","湘潭","襄阳","新乡","邢台","孝感","西宁"],
	    "Y": ["烟台","延安","扬州","宜昌","盐城","岳阳","银川","延边","鹰潭"],
	    "Z": ["郑州","珠海","张家口","中山","淄博","株洲","漳州","湛江","肇庆"],
};

var str = "ABCDEFGHJKLMNPQRSTWXYZ";
var arr = str.split("");
!(function ($){
	var city = {
		init:function(e){
			this.addKey();
			this.addCity(e);
			this.addTouch();
		},

		addKey:function(){
	        var div = "";
	        arr.forEach(function (item, i) {
	            div += '<a href="#' + item + '">' + item + '</a>';
	        });
	        var aaa = '<a href="#aaa"><img src="images/xing.png"></a>';
            $(".anchor").append(aaa);
	        $(".anchor").append(div);
		},

		addCity:function(e){
			var e = $("."+e);
			var div = "<div class ='item' ></div>";
			var span = "";
			var p = "";
			var ul = "<ul></ul>";
			var city = "";
			for(var key in provinces)
			{
				e.append(div);
				var end = $("."+$(e).attr("class")+" .item:last");
				var val = provinces[key];
				p = '<p>'+key+'</p>';
				span = '<span id = '+key+' class = "offset"></span>'
				end.append(span);
				end.append(p);
				end.append(ul);
				end =  end.find('ul');
				city = "";
				for (var i = 0;i<val.length;i++)
				{
					city += '<li>'+val[i]+'</li>';
				}
				end.append(city);
			}
		},
		addTouch:function(){
        	var that = this;
	        var anchor = $(".anchor");

	        var width = anchor.find("a").width();
	        var height = anchor.find("a").height();

			$(".anchor").on('touchmove', function(e) {
				e.preventDefault();
           		var touch = e.originalEvent.touches[0];
            	var x = touch.pageX;
            	var y = touch.pageY;
            	$(this).find("a").each(function (i, item) {
            		var offset = $(item).offset();
            		var left = offset.left, top = offset.top;
            		if (x > left && x < (left + width) && y > top && y < (top + height)) {
	                    location.href = item.href;
                	}
            	});
			});
		}
	};

	$.fn.start = function (el) {
		city.init(el);
    };


} (jQuery));