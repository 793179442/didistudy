/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * 
 * @param {type} cp 起始页
 * @param {type} sc 翻页页显示的个数
 * @param {type} pc 总页数
 * @param {type} pageobj 显示分页的对象
 * @param {type} urlname 链接
 * @returns {undefined}
 */
function page(cp, sc, pc, pageobj, urlname) {

    var li, lia, i;
    li = document.createElement('li');
    if (cp != 1 && cp != 0) {
        lia = document.createElement('a');
        lia.href = urlname + "&page=" + 1;
        lia.innerHTML = "首页";
    } else {
        lia = document.createElement('a');
        li.className = 'disabled';
        lia.href = 'javascript:void(0);';
        lia.innerHTML = "首页";
    }
    li.appendChild(lia);
    pageobj.appendChild(li);

    li = document.createElement('li');
    if (cp != 1 && cp != 0) {
        lia = document.createElement('a');
        lia.href = urlname + "&page=" + (cp - 1);
        lia.innerHTML = "上一页";
    } else {
        lia = document.createElement('a');
        li.className = 'disabled';
        lia.href = 'javascript:void(0);';
        lia.innerHTML = "上一页";
    }
    li.appendChild(lia);
    pageobj.appendChild(li);

    if (pc == 0) {
        li = document.createElement('li');
        lia = document.createElement('a');
        lia.innerHTML = "0";
        lia.href = 'javascript:void(0);';
        li.className = 'disabled';
        li.appendChild(lia);
        pageobj.appendChild(li);
    } else if (pc <= 7) {
        for (i = 1; i <= pc; i++) {
            li = document.createElement('li');
            if (i == cp) {
                lia = document.createElement('a');
                lia.href = 'javascript:void(0);';
                li.className = "active";
                lia.innerHTML = i;
            } else {
                lia = document.createElement('a');
                lia.href = urlname + "&page=" + i;
                lia.innerHTML = i;
            }
            li.appendChild(lia);
            pageobj.appendChild(li);
        }
    } else {
        //alert(cp+"-"+sc+"-"+pc);
        var _cp = cp > pc ? 1 : cp || 1;
        var _sc = sc > pc ? 7 : sc || 7;
        var _pc = pc;
        if (_sc % 2 == 0) {
            _sc = _sc - 1;
        }

        //alert(_cp+"-"+_sc+"-"+_pc);
        //pageobj.innerHTML = null;
        //alert(pageobj);

        if (_cp <= (_sc - 1) / 2) {
            for (i = 1; i <= _sc; i++) {
                li = document.createElement('li');
                if (i == _cp) {
                    lia = document.createElement('a');
                    lia.href = 'javascript:void(0);';
                    li.className = "active";
                    lia.innerHTML = i;
                } else {
                    lia = document.createElement('a');
                    lia.href = urlname + "&page=" + i;
                    lia.innerHTML = i;
                }
                li.appendChild(lia);
                pageobj.appendChild(li);
            }
//            li = document.createElement('li');
//            lia = document.createElement('a');
//            lia.href = urlname + "&page=" + _pc;
//            lia.innerHTML = "..." + _pc;
//            li.appendChild(lia);
//            pageobj.appendChild(li);
        } else if (_cp <= _pc && _cp >= _pc - (_sc - 1) / 2) {
//            li = document.createElement('li');
//            lia = document.createElement('a');
//            lia.href = urlname + "&page=" + 1;
//            lia.innerHTML = "1...";
//            li.appendChild(lia);
//            pageobj.appendChild(li);
            for (i = _pc - _sc + 1; i <= _pc; i++) {
                li = document.createElement('li');
                if (i == _cp) {
                    lia = document.createElement('a');
                    lia.href = 'javascript:void(0);';
                    li.className = "active";
                    lia.innerHTML = i;
                } else {
                    lia = document.createElement('a');
                    lia.href = urlname + "&page=" + i;
                    lia.innerHTML = i;
                }
                li.appendChild(lia);
                pageobj.appendChild(li);
            }
        } else {
//            li = document.createElement('li');
//            lia = document.createElement('a');
//            lia.href = urlname + "&page=" + 1;
//            lia.innerHTML = "1...";
//            li.appendChild(lia);
//            pageobj.appendChild(li);

            for (i = _cp - (_sc - 1) / 2; i < (_cp + _sc - (_sc - 1) / 2); i++) {
                li = document.createElement('li');
                if (i == _cp) {
                    lia = document.createElement('a');
                    lia.href = 'javascript:void(0);';
                    li.className = "active";
                    lia.innerHTML = i;
                } else {
                    lia = document.createElement('a');
                    lia.href = urlname + "&page=" + i;
                    lia.innerHTML = i;
                }
                li.appendChild(lia);
                pageobj.appendChild(li);
            }

//            li = document.createElement('li');
//            lia = document.createElement('a');
//            lia.href = urlname + "&page=" + _pc;
//            lia.innerHTML = "..." + _pc;
//            li.appendChild(lia);
//            pageobj.appendChild(li);
        }
    }
    li = document.createElement('li');
    if (cp != pc) {
        lia = document.createElement('a');
        lia.href = urlname + "&page=" + (cp + 1);
        lia.innerHTML = "下一页";
    } else {
        lia = document.createElement('a');
        lia.href = 'javascript:void(0);';
        li.className = 'disabled';
        lia.innerHTML = "下一页";
    }
    li.appendChild(lia);
    pageobj.appendChild(li);

    li = document.createElement('li');
    if (cp != pc) {
        lia = document.createElement('a');
        lia.href = urlname + "&page=" + pc;
        lia.innerHTML = "末页";
    } else {
        lia = document.createElement('a');
        lia.href = 'javascript:void(0);';
        li.className = 'disabled';
        lia.innerHTML = "末页";
    }
    li.appendChild(lia);
    pageobj.appendChild(li);
}