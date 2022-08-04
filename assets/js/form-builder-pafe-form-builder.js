!function(e,F){"function"==typeof define&&define.amd?define(["exports"],F):"object"==typeof exports&&"string"!=typeof exports.nodeName?F(exports):F(e.IBAN={})}(this,function(e){Array.prototype.map||(Array.prototype.map=function(e){"use strict";if(null==this)throw new TypeError;var F=Object(this),n=F.length>>>0;if("function"!=typeof e)throw new TypeError;for(var t=new Array(n),r=arguments.length>=2?arguments[1]:void 0,A=0;A<n;A++)A in F&&(t[A]=e.call(r,F[A],A,F));return t});var F="A".charCodeAt(0),n="Z".charCodeAt(0);function t(e){return(e=(e=e.toUpperCase()).substr(4)+e.substr(0,4)).split("").map(function(e){var t=e.charCodeAt(0);return t>=F&&t<=n?t-F+10:e}).join("")}function r(e){for(var F,n=e;n.length>2;)F=n.slice(0,9),n=parseInt(F,10)%97+n.slice(F.length);return parseInt(n,10)%97}function A(e){return e.replace(B,"").toUpperCase()}function w(e,F,n,t){this.countryCode=e,this.length=F,this.structure=n,this.example=t}w.prototype._regex=function(){return this._cachedRegex||(this._cachedRegex=(e=this.structure,F=e.match(/(.{3})/g).map(function(e){var F,n=e.slice(0,1),t=parseInt(e.slice(1),10);switch(n){case"A":F="0-9A-Za-z";break;case"B":F="0-9A-Z";break;case"C":F="A-Za-z";break;case"F":F="0-9";break;case"L":F="a-z";break;case"U":F="A-Z";break;case"W":F="0-9a-z"}return"(["+F+"]{"+t+"})"}),new RegExp("^"+F.join("")+"$")));var e,F},w.prototype.isValid=function(e){return this.length==e.length&&this.countryCode===e.slice(0,2)&&this._regex().test(e.slice(4))&&1==r(t(e))},w.prototype.toBBAN=function(e,F){return this._regex().exec(e.slice(4)).slice(1).join(F)},w.prototype.fromBBAN=function(e){if(!this.isValidBBAN(e))throw new Error("Invalid BBAN");var F=("0"+(98-r(t(this.countryCode+"00"+e)))).slice(-2);return this.countryCode+F+e},w.prototype.isValidBBAN=function(e){return this.length-4==e.length&&this._regex().test(e)};var i={};function o(e){i[e.countryCode]=e}o(new w("AD",24,"F04F04A12","AD1200012030200359100100")),o(new w("AE",23,"F03F16","AE070331234567890123456")),o(new w("AL",28,"F08A16","AL47212110090000000235698741")),o(new w("AT",20,"F05F11","AT611904300234573201")),o(new w("AZ",28,"U04A20","AZ21NABZ00000000137010001944")),o(new w("BA",20,"F03F03F08F02","BA391290079401028494")),o(new w("BE",16,"F03F07F02","BE68539007547034")),o(new w("BG",22,"U04F04F02A08","BG80BNBG96611020345678")),o(new w("BH",22,"U04A14","BH67BMAG00001299123456")),o(new w("BR",29,"F08F05F10U01A01","BR9700360305000010009795493P1")),o(new w("BY",28,"A04F04A16","BY13NBRB3600900000002Z00AB00")),o(new w("CH",21,"F05A12","CH9300762011623852957")),o(new w("CR",22,"F04F14","CR72012300000171549015")),o(new w("CY",28,"F03F05A16","CY17002001280000001200527600")),o(new w("CZ",24,"F04F06F10","CZ6508000000192000145399")),o(new w("DE",22,"F08F10","DE89370400440532013000")),o(new w("DK",18,"F04F09F01","DK5000400440116243")),o(new w("DO",28,"U04F20","DO28BAGR00000001212453611324")),o(new w("EE",20,"F02F02F11F01","EE382200221020145685")),o(new w("EG",29,"F04F04F17","EG800002000156789012345180002")),o(new w("ES",24,"F04F04F01F01F10","ES9121000418450200051332")),o(new w("FI",18,"F06F07F01","FI2112345600000785")),o(new w("FO",18,"F04F09F01","FO6264600001631634")),o(new w("FR",27,"F05F05A11F02","FR1420041010050500013M02606")),o(new w("GB",22,"U04F06F08","GB29NWBK60161331926819")),o(new w("GE",22,"U02F16","GE29NB0000000101904917")),o(new w("GI",23,"U04A15","GI75NWBK000000007099453")),o(new w("GL",18,"F04F09F01","GL8964710001000206")),o(new w("GR",27,"F03F04A16","GR1601101250000000012300695")),o(new w("GT",28,"A04A20","GT82TRAJ01020000001210029690")),o(new w("HR",21,"F07F10","HR1210010051863000160")),o(new w("HU",28,"F03F04F01F15F01","HU42117730161111101800000000")),o(new w("IE",22,"U04F06F08","IE29AIBK93115212345678")),o(new w("IL",23,"F03F03F13","IL620108000000099999999")),o(new w("IS",26,"F04F02F06F10","IS140159260076545510730339")),o(new w("IT",27,"U01F05F05A12","IT60X0542811101000000123456")),o(new w("IQ",23,"U04F03A12","IQ98NBIQ850123456789012")),o(new w("JO",30,"A04F22","JO15AAAA1234567890123456789012")),o(new w("KW",30,"U04A22","KW81CBKU0000000000001234560101")),o(new w("KZ",20,"F03A13","KZ86125KZT5004100100")),o(new w("LB",28,"F04A20","LB62099900000001001901229114")),o(new w("LC",32,"U04F24","LC07HEMM000100010012001200013015")),o(new w("LI",21,"F05A12","LI21088100002324013AA")),o(new w("LT",20,"F05F11","LT121000011101001000")),o(new w("LU",20,"F03A13","LU280019400644750000")),o(new w("LV",21,"U04A13","LV80BANK0000435195001")),o(new w("MC",27,"F05F05A11F02","MC5811222000010123456789030")),o(new w("MD",24,"U02A18","MD24AG000225100013104168")),o(new w("ME",22,"F03F13F02","ME25505000012345678951")),o(new w("MK",19,"F03A10F02","MK07250120000058984")),o(new w("MR",27,"F05F05F11F02","MR1300020001010000123456753")),o(new w("MT",31,"U04F05A18","MT84MALT011000012345MTLCAST001S")),o(new w("MU",30,"U04F02F02F12F03U03","MU17BOMM0101101030300200000MUR")),o(new w("NL",18,"U04F10","NL91ABNA0417164300")),o(new w("NO",15,"F04F06F01","NO9386011117947")),o(new w("PK",24,"U04A16","PK36SCBL0000001123456702")),o(new w("PL",28,"F08F16","PL61109010140000071219812874")),o(new w("PS",29,"U04A21","PS92PALS000000000400123456702")),o(new w("PT",25,"F04F04F11F02","PT50000201231234567890154")),o(new w("QA",29,"U04A21","QA30AAAA123456789012345678901")),o(new w("RO",24,"U04A16","RO49AAAA1B31007593840000")),o(new w("RS",22,"F03F13F02","RS35260005601001611379")),o(new w("SA",24,"F02A18","SA0380000000608010167519")),o(new w("SC",31,"U04F04F16U03","SC18SSCB11010000000000001497USD")),o(new w("SE",24,"F03F16F01","SE4550000000058398257466")),o(new w("SI",19,"F05F08F02","SI56263300012039086")),o(new w("SK",24,"F04F06F10","SK3112000000198742637541")),o(new w("SM",27,"U01F05F05A12","SM86U0322509800000000270100")),o(new w("ST",25,"F08F11F02","ST68000100010051845310112")),o(new w("SV",28,"U04F20","SV62CENR00000000000000700025")),o(new w("TL",23,"F03F14F02","TL380080012345678910157")),o(new w("TN",24,"F02F03F13F02","TN5910006035183598478831")),o(new w("TR",26,"F05F01A16","TR330006100519786457841326")),o(new w("UA",29,"F25","UA511234567890123456789012345")),o(new w("VA",22,"F18","VA59001123000012345678")),o(new w("VG",24,"U04F16","VG96VPVG0000012345678901")),o(new w("XK",20,"F04F10F02","XK051212012345678906")),o(new w("AO",25,"F21","AO69123456789012345678901")),o(new w("BF",27,"F23","BF2312345678901234567890123")),o(new w("BI",16,"F12","BI41123456789012")),o(new w("BJ",28,"F24","BJ39123456789012345678901234")),o(new w("CI",28,"U02F22","CI70CI1234567890123456789012")),o(new w("CM",27,"F23","CM9012345678901234567890123")),o(new w("CV",25,"F21","CV30123456789012345678901")),o(new w("DZ",24,"F20","DZ8612345678901234567890")),o(new w("IR",26,"F22","IR861234568790123456789012")),o(new w("MG",27,"F23","MG1812345678901234567890123")),o(new w("ML",28,"U01F23","ML15A12345678901234567890123")),o(new w("MZ",25,"F21","MZ25123456789012345678901")),o(new w("SN",28,"U01F23","SN52A12345678901234567890123")),o(new w("GF",27,"F05F05A11F02","GF121234512345123456789AB13")),o(new w("GP",27,"F05F05A11F02","GP791234512345123456789AB13")),o(new w("MQ",27,"F05F05A11F02","MQ221234512345123456789AB13")),o(new w("RE",27,"F05F05A11F02","RE131234512345123456789AB13")),o(new w("PF",27,"F05F05A11F02","PF281234512345123456789AB13")),o(new w("TF",27,"F05F05A11F02","TF891234512345123456789AB13")),o(new w("YT",27,"F05F05A11F02","YT021234512345123456789AB13")),o(new w("NC",27,"F05F05A11F02","NC551234512345123456789AB13")),o(new w("BL",27,"F05F05A11F02","BL391234512345123456789AB13")),o(new w("MF",27,"F05F05A11F02","MF551234512345123456789AB13")),o(new w("PM",27,"F05F05A11F02","PM071234512345123456789AB13")),o(new w("WF",27,"F05F05A11F02","WF621234512345123456789AB13"));var B=/[^a-zA-Z0-9]/g,c=/(.{4})(?!$)/g;function s(e){return"string"==typeof e||e instanceof String}e.isValid=function(e){if(!s(e))return!1;e=A(e);var F=i[e.slice(0,2)];return!!F&&F.isValid(e)},e.toBBAN=function(e,F){void 0===F&&(F=" "),e=A(e);var n=i[e.slice(0,2)];if(!n)throw new Error("No country with code "+e.slice(0,2));return n.toBBAN(e,F)},e.fromBBAN=function(e,F){var n=i[e];if(!n)throw new Error("No country with code "+e);return n.fromBBAN(A(F))},e.isValidBBAN=function(e,F){if(!s(F))return!1;var n=i[e];return n&&n.isValidBBAN(A(F))},e.printFormat=function(e,F){return void 0===F&&(F=" "),A(e).replace(c,"$1"+F)},e.electronicFormat=A,e.countries=i});
/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
 
// Ion.RangeSlider, 2.3.0, © Denis Ineshin, 2010 - 2018, IonDen.com, Build date: 2018-12-12 00:00:37
!function(i){!jQuery&&"function"==typeof define&&define.amd?define(["jquery"],function(t){return i(t,document,window,navigator)}):jQuery||"object"!=typeof exports?i(jQuery,document,window,navigator):i(require("jquery"),document,window,navigator)}(function(a,c,l,t,_){"use strict";var i,s,o=0,e=(i=t.userAgent,s=/msie\s\d+/i,0<i.search(s)&&s.exec(i).toString().split(" ")[1]<9&&(a("html").addClass("lt-ie9"),!0));Function.prototype.bind||(Function.prototype.bind=function(o){var e=this,h=[].slice;if("function"!=typeof e)throw new TypeError;var r=h.call(arguments,1),n=function(){if(this instanceof n){var t=function(){};t.prototype=e.prototype;var i=new t,s=e.apply(i,r.concat(h.call(arguments)));return Object(s)===s?s:i}return e.apply(o,r.concat(h.call(arguments)))};return n}),Array.prototype.indexOf||(Array.prototype.indexOf=function(t,i){var s;if(null==this)throw new TypeError('"this" is null or not defined');var o=Object(this),e=o.length>>>0;if(0===e)return-1;var h=+i||0;if(Math.abs(h)===1/0&&(h=0),e<=h)return-1;for(s=Math.max(0<=h?h:e-Math.abs(h),0);s<e;){if(s in o&&o[s]===t)return s;s++}return-1});var h=function(t,i,s){this.VERSION="2.3.0",this.input=t,this.plugin_count=s,this.current_plugin=0,this.calc_count=0,this.update_tm=0,this.old_from=0,this.old_to=0,this.old_min_interval=null,this.raf_id=null,this.dragging=!1,this.force_redraw=!1,this.no_diapason=!1,this.has_tab_index=!0,this.is_key=!1,this.is_update=!1,this.is_start=!0,this.is_finish=!1,this.is_active=!1,this.is_resize=!1,this.is_click=!1,i=i||{},this.$cache={win:a(l),body:a(c.body),input:a(t),cont:null,rs:null,min:null,max:null,from:null,to:null,single:null,bar:null,line:null,s_single:null,s_from:null,s_to:null,shad_single:null,shad_from:null,shad_to:null,edge:null,grid:null,grid_labels:[]},this.coords={x_gap:0,x_pointer:0,w_rs:0,w_rs_old:0,w_handle:0,p_gap:0,p_gap_left:0,p_gap_right:0,p_step:0,p_pointer:0,p_handle:0,p_single_fake:0,p_single_real:0,p_from_fake:0,p_from_real:0,p_to_fake:0,p_to_real:0,p_bar_x:0,p_bar_w:0,grid_gap:0,big_num:0,big:[],big_w:[],big_p:[],big_x:[]},this.labels={w_min:0,w_max:0,w_from:0,w_to:0,w_single:0,p_min:0,p_max:0,p_from_fake:0,p_from_left:0,p_to_fake:0,p_to_left:0,p_single_fake:0,p_single_left:0};var o,e,h,r=this.$cache.input,n=r.prop("value");for(h in o={skin:"flat",type:"single",min:10,max:100,from:null,to:null,step:1,min_interval:0,max_interval:0,drag_interval:!1,values:[],p_values:[],from_fixed:!1,from_min:null,from_max:null,from_shadow:!1,to_fixed:!1,to_min:null,to_max:null,to_shadow:!1,prettify_enabled:!0,prettify_separator:" ",prettify:null,force_edges:!1,keyboard:!0,grid:!1,grid_margin:!0,grid_num:4,grid_snap:!1,hide_min_max:!1,hide_from_to:!1,prefix:"",postfix:"",max_postfix:"",decorate_both:!0,values_separator:" — ",input_values_separator:";",disable:!1,block:!1,extra_classes:"",scope:null,onStart:null,onChange:null,onFinish:null,onUpdate:null},"INPUT"!==r[0].nodeName&&console&&console.warn&&console.warn("Base element should be <input>!",r[0]),(e={skin:r.data("skin"),type:r.data("type"),min:r.data("min"),max:r.data("max"),from:r.data("from"),to:r.data("to"),step:r.data("step"),min_interval:r.data("minInterval"),max_interval:r.data("maxInterval"),drag_interval:r.data("dragInterval"),values:r.data("values"),from_fixed:r.data("fromFixed"),from_min:r.data("fromMin"),from_max:r.data("fromMax"),from_shadow:r.data("fromShadow"),to_fixed:r.data("toFixed"),to_min:r.data("toMin"),to_max:r.data("toMax"),to_shadow:r.data("toShadow"),prettify_enabled:r.data("prettifyEnabled"),prettify_separator:r.data("prettifySeparator"),force_edges:r.data("forceEdges"),keyboard:r.data("keyboard"),grid:r.data("grid"),grid_margin:r.data("gridMargin"),grid_num:r.data("gridNum"),grid_snap:r.data("gridSnap"),hide_min_max:r.data("hideMinMax"),hide_from_to:r.data("hideFromTo"),prefix:r.data("prefix"),postfix:r.data("postfix"),max_postfix:r.data("maxPostfix"),decorate_both:r.data("decorateBoth"),values_separator:r.data("valuesSeparator"),input_values_separator:r.data("inputValuesSeparator"),disable:r.data("disable"),block:r.data("block"),extra_classes:r.data("extraClasses")}).values=e.values&&e.values.split(","),e)e.hasOwnProperty(h)&&(e[h]!==_&&""!==e[h]||delete e[h]);n!==_&&""!==n&&((n=n.split(e.input_values_separator||i.input_values_separator||";"))[0]&&n[0]==+n[0]&&(n[0]=+n[0]),n[1]&&n[1]==+n[1]&&(n[1]=+n[1]),i&&i.values&&i.values.length?(o.from=n[0]&&i.values.indexOf(n[0]),o.to=n[1]&&i.values.indexOf(n[1])):(o.from=n[0]&&+n[0],o.to=n[1]&&+n[1])),a.extend(o,i),a.extend(o,e),this.options=o,this.update_check={},this.validate(),this.result={input:this.$cache.input,slider:null,min:this.options.min,max:this.options.max,from:this.options.from,from_percent:0,from_value:null,to:this.options.to,to_percent:0,to_value:null},this.init()};h.prototype={init:function(t){this.no_diapason=!1,this.coords.p_step=this.convertToPercent(this.options.step,!0),this.target="base",this.toggleInput(),this.append(),this.setMinMax(),t?(this.force_redraw=!0,this.calc(!0),this.callOnUpdate()):(this.force_redraw=!0,this.calc(!0),this.callOnStart()),this.updateScene()},append:function(){var t='<span class="irs irs--'+this.options.skin+" js-irs-"+this.plugin_count+" "+this.options.extra_classes+'"></span>';this.$cache.input.before(t),this.$cache.input.prop("readonly",!0),this.$cache.cont=this.$cache.input.prev(),this.result.slider=this.$cache.cont,this.$cache.cont.html('<span class="irs"><span class="irs-line" tabindex="0"></span><span class="irs-min">0</span><span class="irs-max">1</span><span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span>'),this.$cache.rs=this.$cache.cont.find(".irs"),this.$cache.min=this.$cache.cont.find(".irs-min"),this.$cache.max=this.$cache.cont.find(".irs-max"),this.$cache.from=this.$cache.cont.find(".irs-from"),this.$cache.to=this.$cache.cont.find(".irs-to"),this.$cache.single=this.$cache.cont.find(".irs-single"),this.$cache.line=this.$cache.cont.find(".irs-line"),this.$cache.grid=this.$cache.cont.find(".irs-grid"),"single"===this.options.type?(this.$cache.cont.append('<span class="irs-bar irs-bar--single"></span><span class="irs-shadow shadow-single"></span><span class="irs-handle single"><i></i><i></i><i></i></span>'),this.$cache.bar=this.$cache.cont.find(".irs-bar"),this.$cache.edge=this.$cache.cont.find(".irs-bar-edge"),this.$cache.s_single=this.$cache.cont.find(".single"),this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.shad_single=this.$cache.cont.find(".shadow-single")):(this.$cache.cont.append('<span class="irs-bar"></span><span class="irs-shadow shadow-from"></span><span class="irs-shadow shadow-to"></span><span class="irs-handle from"><i></i><i></i><i></i></span><span class="irs-handle to"><i></i><i></i><i></i></span>'),this.$cache.bar=this.$cache.cont.find(".irs-bar"),this.$cache.s_from=this.$cache.cont.find(".from"),this.$cache.s_to=this.$cache.cont.find(".to"),this.$cache.shad_from=this.$cache.cont.find(".shadow-from"),this.$cache.shad_to=this.$cache.cont.find(".shadow-to"),this.setTopHandler()),this.options.hide_from_to&&(this.$cache.from[0].style.display="none",this.$cache.to[0].style.display="none",this.$cache.single[0].style.display="none"),this.appendGrid(),this.options.disable?(this.appendDisableMask(),this.$cache.input[0].disabled=!0):(this.$cache.input[0].disabled=!1,this.removeDisableMask(),this.bindEvents()),this.options.disable||(this.options.block?this.appendDisableMask():this.removeDisableMask()),this.options.drag_interval&&(this.$cache.bar[0].style.cursor="ew-resize")},setTopHandler:function(){var t=this.options.min,i=this.options.max,s=this.options.from,o=this.options.to;t<s&&o===i?this.$cache.s_from.addClass("type_last"):o<i&&this.$cache.s_to.addClass("type_last")},changeLevel:function(t){switch(t){case"single":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_single_fake),this.$cache.s_single.addClass("state_hover");break;case"from":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_from_fake),this.$cache.s_from.addClass("state_hover"),this.$cache.s_from.addClass("type_last"),this.$cache.s_to.removeClass("type_last");break;case"to":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_to_fake),this.$cache.s_to.addClass("state_hover"),this.$cache.s_to.addClass("type_last"),this.$cache.s_from.removeClass("type_last");break;case"both":this.coords.p_gap_left=this.toFixed(this.coords.p_pointer-this.coords.p_from_fake),this.coords.p_gap_right=this.toFixed(this.coords.p_to_fake-this.coords.p_pointer),this.$cache.s_to.removeClass("type_last"),this.$cache.s_from.removeClass("type_last")}},appendDisableMask:function(){this.$cache.cont.append('<span class="irs-disable-mask"></span>'),this.$cache.cont.addClass("irs-disabled")},removeDisableMask:function(){this.$cache.cont.remove(".irs-disable-mask"),this.$cache.cont.removeClass("irs-disabled")},remove:function(){this.$cache.cont.remove(),this.$cache.cont=null,this.$cache.line.off("keydown.irs_"+this.plugin_count),this.$cache.body.off("touchmove.irs_"+this.plugin_count),this.$cache.body.off("mousemove.irs_"+this.plugin_count),this.$cache.win.off("touchend.irs_"+this.plugin_count),this.$cache.win.off("mouseup.irs_"+this.plugin_count),e&&(this.$cache.body.off("mouseup.irs_"+this.plugin_count),this.$cache.body.off("mouseleave.irs_"+this.plugin_count)),this.$cache.grid_labels=[],this.coords.big=[],this.coords.big_w=[],this.coords.big_p=[],this.coords.big_x=[],cancelAnimationFrame(this.raf_id)},bindEvents:function(){this.no_diapason||(this.$cache.body.on("touchmove.irs_"+this.plugin_count,this.pointerMove.bind(this)),this.$cache.body.on("mousemove.irs_"+this.plugin_count,this.pointerMove.bind(this)),this.$cache.win.on("touchend.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.win.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.line.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.line.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.line.on("focus.irs_"+this.plugin_count,this.pointerFocus.bind(this)),this.options.drag_interval&&"double"===this.options.type?(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"both")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"both"))):(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))),"single"===this.options.type?(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.shad_single.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.edge.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_single.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))):(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,null)),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,null)),this.$cache.from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))),this.options.keyboard&&this.$cache.line.on("keydown.irs_"+this.plugin_count,this.key.bind(this,"keyboard")),e&&(this.$cache.body.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.body.on("mouseleave.irs_"+this.plugin_count,this.pointerUp.bind(this))))},pointerFocus:function(t){var i,s;this.target||(i=(s="single"===this.options.type?this.$cache.single:this.$cache.from).offset().left,i+=s.width()/2-1,this.pointerClick("single",{preventDefault:function(){},pageX:i}))},pointerMove:function(t){if(this.dragging){var i=t.pageX||t.originalEvent.touches&&t.originalEvent.touches[0].pageX;this.coords.x_pointer=i-this.coords.x_gap,this.calc()}},pointerUp:function(t){this.current_plugin===this.plugin_count&&this.is_active&&(this.is_active=!1,this.$cache.cont.find(".state_hover").removeClass("state_hover"),this.force_redraw=!0,e&&a("*").prop("unselectable",!1),this.updateScene(),this.restoreOriginalMinInterval(),(a.contains(this.$cache.cont[0],t.target)||this.dragging)&&this.callOnFinish(),this.dragging=!1)},pointerDown:function(t,i){i.preventDefault();var s=i.pageX||i.originalEvent.touches&&i.originalEvent.touches[0].pageX;2!==i.button&&("both"===t&&this.setTempMinInterval(),t||(t=this.target||"from"),this.current_plugin=this.plugin_count,this.target=t,this.is_active=!0,this.dragging=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=s-this.coords.x_gap,this.calcPointerPercent(),this.changeLevel(t),e&&a("*").prop("unselectable",!0),this.$cache.line.trigger("focus"),this.updateScene())},pointerClick:function(t,i){i.preventDefault();var s=i.pageX||i.originalEvent.touches&&i.originalEvent.touches[0].pageX;2!==i.button&&(this.current_plugin=this.plugin_count,this.target=t,this.is_click=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=+(s-this.coords.x_gap).toFixed(),this.force_redraw=!0,this.calc(),this.$cache.line.trigger("focus"))},key:function(t,i){if(!(this.current_plugin!==this.plugin_count||i.altKey||i.ctrlKey||i.shiftKey||i.metaKey)){switch(i.which){case 83:case 65:case 40:case 37:i.preventDefault(),this.moveByKey(!1);break;case 87:case 68:case 38:case 39:i.preventDefault(),this.moveByKey(!0)}return!0}},moveByKey:function(t){var i=this.coords.p_pointer,s=(this.options.max-this.options.min)/100;s=this.options.step/s,t?i+=s:i-=s,this.coords.x_pointer=this.toFixed(this.coords.w_rs/100*i),this.is_key=!0,this.calc()},setMinMax:function(){if(this.options){if(this.options.hide_min_max)return this.$cache.min[0].style.display="none",void(this.$cache.max[0].style.display="none");if(this.options.values.length)this.$cache.min.html(this.decorate(this.options.p_values[this.options.min])),this.$cache.max.html(this.decorate(this.options.p_values[this.options.max]));else{var t=this._prettify(this.options.min),i=this._prettify(this.options.max);this.result.min_pretty=t,this.result.max_pretty=i,this.$cache.min.html(this.decorate(t,this.options.min)),this.$cache.max.html(this.decorate(i,this.options.max))}this.labels.w_min=this.$cache.min.outerWidth(!1),this.labels.w_max=this.$cache.max.outerWidth(!1)}},setTempMinInterval:function(){var t=this.result.to-this.result.from;null===this.old_min_interval&&(this.old_min_interval=this.options.min_interval),this.options.min_interval=t},restoreOriginalMinInterval:function(){null!==this.old_min_interval&&(this.options.min_interval=this.old_min_interval,this.old_min_interval=null)},calc:function(t){if(this.options&&(this.calc_count++,(10===this.calc_count||t)&&(this.calc_count=0,this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.calcHandlePercent()),this.coords.w_rs)){this.calcPointerPercent();var i=this.getHandleX();switch("both"===this.target&&(this.coords.p_gap=0,i=this.getHandleX()),"click"===this.target&&(this.coords.p_gap=this.coords.p_handle/2,i=this.getHandleX(),this.options.drag_interval?this.target="both_one":this.target=this.chooseHandle(i)),this.target){case"base":var s=(this.options.max-this.options.min)/100,o=(this.result.from-this.options.min)/s,e=(this.result.to-this.options.min)/s;this.coords.p_single_real=this.toFixed(o),this.coords.p_from_real=this.toFixed(o),this.coords.p_to_real=this.toFixed(e),this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_single_fake=this.convertToFakePercent(this.coords.p_single_real),this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real),this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real),this.target=null;break;case"single":if(this.options.from_fixed)break;this.coords.p_single_real=this.convertToRealPercent(i),this.coords.p_single_real=this.calcWithStep(this.coords.p_single_real),this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max),this.coords.p_single_fake=this.convertToFakePercent(this.coords.p_single_real);break;case"from":if(this.options.from_fixed)break;this.coords.p_from_real=this.convertToRealPercent(i),this.coords.p_from_real=this.calcWithStep(this.coords.p_from_real),this.coords.p_from_real>this.coords.p_to_real&&(this.coords.p_from_real=this.coords.p_to_real),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from_real=this.checkMaxInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real);break;case"to":if(this.options.to_fixed)break;this.coords.p_to_real=this.convertToRealPercent(i),this.coords.p_to_real=this.calcWithStep(this.coords.p_to_real),this.coords.p_to_real<this.coords.p_from_real&&(this.coords.p_to_real=this.coords.p_from_real),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to_real=this.checkMaxInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real);break;case"both":if(this.options.from_fixed||this.options.to_fixed)break;i=this.toFixed(i+.001*this.coords.p_handle),this.coords.p_from_real=this.convertToRealPercent(i)-this.coords.p_gap_left,this.coords.p_from_real=this.calcWithStep(this.coords.p_from_real),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real),this.coords.p_to_real=this.convertToRealPercent(i)+this.coords.p_gap_right,this.coords.p_to_real=this.calcWithStep(this.coords.p_to_real),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real);break;case"both_one":if(this.options.from_fixed||this.options.to_fixed)break;var h=this.convertToRealPercent(i),r=this.result.from_percent,n=this.result.to_percent-r,a=n/2,c=h-a,l=h+a;c<0&&(l=(c=0)+n),100<l&&(c=(l=100)-n),this.coords.p_from_real=this.calcWithStep(c),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real),this.coords.p_to_real=this.calcWithStep(l),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real)}"single"===this.options.type?(this.coords.p_bar_x=this.coords.p_handle/2,this.coords.p_bar_w=this.coords.p_single_fake,this.result.from_percent=this.coords.p_single_real,this.result.from=this.convertToValue(this.coords.p_single_real),this.result.from_pretty=this._prettify(this.result.from),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from])):(this.coords.p_bar_x=this.toFixed(this.coords.p_from_fake+this.coords.p_handle/2),this.coords.p_bar_w=this.toFixed(this.coords.p_to_fake-this.coords.p_from_fake),this.result.from_percent=this.coords.p_from_real,this.result.from=this.convertToValue(this.coords.p_from_real),this.result.from_pretty=this._prettify(this.result.from),this.result.to_percent=this.coords.p_to_real,this.result.to=this.convertToValue(this.coords.p_to_real),this.result.to_pretty=this._prettify(this.result.to),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from],this.result.to_value=this.options.values[this.result.to])),this.calcMinMax(),this.calcLabels()}},calcPointerPercent:function(){this.coords.w_rs?(this.coords.x_pointer<0||isNaN(this.coords.x_pointer)?this.coords.x_pointer=0:this.coords.x_pointer>this.coords.w_rs&&(this.coords.x_pointer=this.coords.w_rs),this.coords.p_pointer=this.toFixed(this.coords.x_pointer/this.coords.w_rs*100)):this.coords.p_pointer=0},convertToRealPercent:function(t){return t/(100-this.coords.p_handle)*100},convertToFakePercent:function(t){return t/100*(100-this.coords.p_handle)},getHandleX:function(){var t=100-this.coords.p_handle,i=this.toFixed(this.coords.p_pointer-this.coords.p_gap);return i<0?i=0:t<i&&(i=t),i},calcHandlePercent:function(){"single"===this.options.type?this.coords.w_handle=this.$cache.s_single.outerWidth(!1):this.coords.w_handle=this.$cache.s_from.outerWidth(!1),this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100)},chooseHandle:function(t){return"single"===this.options.type?"single":this.coords.p_from_real+(this.coords.p_to_real-this.coords.p_from_real)/2<=t?this.options.to_fixed?"from":"to":this.options.from_fixed?"to":"from"},calcMinMax:function(){this.coords.w_rs&&(this.labels.p_min=this.labels.w_min/this.coords.w_rs*100,this.labels.p_max=this.labels.w_max/this.coords.w_rs*100)},calcLabels:function(){this.coords.w_rs&&!this.options.hide_from_to&&("single"===this.options.type?(this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single_fake=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=this.coords.p_single_fake+this.coords.p_handle/2-this.labels.p_single_fake/2):(this.labels.w_from=this.$cache.from.outerWidth(!1),this.labels.p_from_fake=this.labels.w_from/this.coords.w_rs*100,this.labels.p_from_left=this.coords.p_from_fake+this.coords.p_handle/2-this.labels.p_from_fake/2,this.labels.p_from_left=this.toFixed(this.labels.p_from_left),this.labels.p_from_left=this.checkEdges(this.labels.p_from_left,this.labels.p_from_fake),this.labels.w_to=this.$cache.to.outerWidth(!1),this.labels.p_to_fake=this.labels.w_to/this.coords.w_rs*100,this.labels.p_to_left=this.coords.p_to_fake+this.coords.p_handle/2-this.labels.p_to_fake/2,this.labels.p_to_left=this.toFixed(this.labels.p_to_left),this.labels.p_to_left=this.checkEdges(this.labels.p_to_left,this.labels.p_to_fake),this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single_fake=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=(this.labels.p_from_left+this.labels.p_to_left+this.labels.p_to_fake)/2-this.labels.p_single_fake/2,this.labels.p_single_left=this.toFixed(this.labels.p_single_left)),this.labels.p_single_left=this.checkEdges(this.labels.p_single_left,this.labels.p_single_fake))},updateScene:function(){this.raf_id&&(cancelAnimationFrame(this.raf_id),this.raf_id=null),clearTimeout(this.update_tm),this.update_tm=null,this.options&&(this.drawHandles(),this.is_active?this.raf_id=requestAnimationFrame(this.updateScene.bind(this)):this.update_tm=setTimeout(this.updateScene.bind(this),300))},drawHandles:function(){this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&(this.coords.w_rs!==this.coords.w_rs_old&&(this.target="base",this.is_resize=!0),(this.coords.w_rs!==this.coords.w_rs_old||this.force_redraw)&&(this.setMinMax(),this.calc(!0),this.drawLabels(),this.options.grid&&(this.calcGridMargin(),this.calcGridLabels()),this.force_redraw=!0,this.coords.w_rs_old=this.coords.w_rs,this.drawShadow()),this.coords.w_rs&&(this.dragging||this.force_redraw||this.is_key)&&((this.old_from!==this.result.from||this.old_to!==this.result.to||this.force_redraw||this.is_key)&&(this.drawLabels(),this.$cache.bar[0].style.left=this.coords.p_bar_x+"%",this.$cache.bar[0].style.width=this.coords.p_bar_w+"%","single"===this.options.type?(this.$cache.bar[0].style.left=0,this.$cache.bar[0].style.width=this.coords.p_bar_w+this.coords.p_bar_x+"%",this.$cache.s_single[0].style.left=this.coords.p_single_fake+"%"):(this.$cache.s_from[0].style.left=this.coords.p_from_fake+"%",this.$cache.s_to[0].style.left=this.coords.p_to_fake+"%",(this.old_from!==this.result.from||this.force_redraw)&&(this.$cache.from[0].style.left=this.labels.p_from_left+"%"),(this.old_to!==this.result.to||this.force_redraw)&&(this.$cache.to[0].style.left=this.labels.p_to_left+"%")),this.$cache.single[0].style.left=this.labels.p_single_left+"%",this.writeToInput(),this.old_from===this.result.from&&this.old_to===this.result.to||this.is_start||(this.$cache.input.trigger("change"),this.$cache.input.trigger("input")),this.old_from=this.result.from,this.old_to=this.result.to,this.is_resize||this.is_update||this.is_start||this.is_finish||this.callOnChange(),(this.is_key||this.is_click)&&(this.is_key=!1,this.is_click=!1,this.callOnFinish()),this.is_update=!1,this.is_resize=!1,this.is_finish=!1),this.is_start=!1,this.is_key=!1,this.is_click=!1,this.force_redraw=!1))},drawLabels:function(){if(this.options){var t,i,s,o,e,h=this.options.values.length,r=this.options.p_values;if(!this.options.hide_from_to)if("single"===this.options.type)t=h?this.decorate(r[this.result.from]):(o=this._prettify(this.result.from),this.decorate(o,this.result.from)),this.$cache.single.html(t),this.calcLabels(),this.labels.p_single_left<this.labels.p_min+1?this.$cache.min[0].style.visibility="hidden":this.$cache.min[0].style.visibility="visible",this.labels.p_single_left+this.labels.p_single_fake>100-this.labels.p_max-1?this.$cache.max[0].style.visibility="hidden":this.$cache.max[0].style.visibility="visible";else{s=h?(this.options.decorate_both?(t=this.decorate(r[this.result.from]),t+=this.options.values_separator,t+=this.decorate(r[this.result.to])):t=this.decorate(r[this.result.from]+this.options.values_separator+r[this.result.to]),i=this.decorate(r[this.result.from]),this.decorate(r[this.result.to])):(o=this._prettify(this.result.from),e=this._prettify(this.result.to),this.options.decorate_both?(t=this.decorate(o,this.result.from),t+=this.options.values_separator,t+=this.decorate(e,this.result.to)):t=this.decorate(o+this.options.values_separator+e,this.result.to),i=this.decorate(o,this.result.from),this.decorate(e,this.result.to)),this.$cache.single.html(t),this.$cache.from.html(i),this.$cache.to.html(s),this.calcLabels();var n=Math.min(this.labels.p_single_left,this.labels.p_from_left),a=this.labels.p_single_left+this.labels.p_single_fake,c=this.labels.p_to_left+this.labels.p_to_fake,l=Math.max(a,c);this.labels.p_from_left+this.labels.p_from_fake>=this.labels.p_to_left?(this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",l=this.result.from===this.result.to?("from"===this.target?this.$cache.from[0].style.visibility="visible":"to"===this.target?this.$cache.to[0].style.visibility="visible":this.target||(this.$cache.from[0].style.visibility="visible"),this.$cache.single[0].style.visibility="hidden",c):(this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",Math.max(a,c))):(this.$cache.from[0].style.visibility="visible",this.$cache.to[0].style.visibility="visible",this.$cache.single[0].style.visibility="hidden"),n<this.labels.p_min+1?this.$cache.min[0].style.visibility="hidden":this.$cache.min[0].style.visibility="visible",l>100-this.labels.p_max-1?this.$cache.max[0].style.visibility="hidden":this.$cache.max[0].style.visibility="visible"}}},drawShadow:function(){var t,i,s,o,e=this.options,h=this.$cache,r="number"==typeof e.from_min&&!isNaN(e.from_min),n="number"==typeof e.from_max&&!isNaN(e.from_max),a="number"==typeof e.to_min&&!isNaN(e.to_min),c="number"==typeof e.to_max&&!isNaN(e.to_max);"single"===e.type?e.from_shadow&&(r||n)?(t=this.convertToPercent(r?e.from_min:e.min),i=this.convertToPercent(n?e.from_max:e.max)-t,t=this.toFixed(t-this.coords.p_handle/100*t),i=this.toFixed(i-this.coords.p_handle/100*i),t+=this.coords.p_handle/2,h.shad_single[0].style.display="block",h.shad_single[0].style.left=t+"%",h.shad_single[0].style.width=i+"%"):h.shad_single[0].style.display="none":(e.from_shadow&&(r||n)?(t=this.convertToPercent(r?e.from_min:e.min),i=this.convertToPercent(n?e.from_max:e.max)-t,t=this.toFixed(t-this.coords.p_handle/100*t),i=this.toFixed(i-this.coords.p_handle/100*i),t+=this.coords.p_handle/2,h.shad_from[0].style.display="block",h.shad_from[0].style.left=t+"%",h.shad_from[0].style.width=i+"%"):h.shad_from[0].style.display="none",e.to_shadow&&(a||c)?(s=this.convertToPercent(a?e.to_min:e.min),o=this.convertToPercent(c?e.to_max:e.max)-s,s=this.toFixed(s-this.coords.p_handle/100*s),o=this.toFixed(o-this.coords.p_handle/100*o),s+=this.coords.p_handle/2,h.shad_to[0].style.display="block",h.shad_to[0].style.left=s+"%",h.shad_to[0].style.width=o+"%"):h.shad_to[0].style.display="none")},writeToInput:function(){"single"===this.options.type?(this.options.values.length?this.$cache.input.prop("value",this.result.from_value):this.$cache.input.prop("value",this.result.from),this.$cache.input.data("from",this.result.from)):(this.options.values.length?this.$cache.input.prop("value",this.result.from_value+this.options.input_values_separator+this.result.to_value):this.$cache.input.prop("value",this.result.from+this.options.input_values_separator+this.result.to),this.$cache.input.data("from",this.result.from),this.$cache.input.data("to",this.result.to))},callOnStart:function(){this.writeToInput(),this.options.onStart&&"function"==typeof this.options.onStart&&(this.options.scope?this.options.onStart.call(this.options.scope,this.result):this.options.onStart(this.result))},callOnChange:function(){this.writeToInput(),this.options.onChange&&"function"==typeof this.options.onChange&&(this.options.scope?this.options.onChange.call(this.options.scope,this.result):this.options.onChange(this.result))},callOnFinish:function(){this.writeToInput(),this.options.onFinish&&"function"==typeof this.options.onFinish&&(this.options.scope?this.options.onFinish.call(this.options.scope,this.result):this.options.onFinish(this.result))},callOnUpdate:function(){this.writeToInput(),this.options.onUpdate&&"function"==typeof this.options.onUpdate&&(this.options.scope?this.options.onUpdate.call(this.options.scope,this.result):this.options.onUpdate(this.result))},toggleInput:function(){this.$cache.input.toggleClass("irs-hidden-input"),this.has_tab_index?this.$cache.input.prop("tabindex",-1):this.$cache.input.removeProp("tabindex"),this.has_tab_index=!this.has_tab_index},convertToPercent:function(t,i){var s,o=this.options.max-this.options.min,e=o/100;return o?(s=(i?t:t-this.options.min)/e,this.toFixed(s)):(this.no_diapason=!0,0)},convertToValue:function(t){var i,s,o=this.options.min,e=this.options.max,h=o.toString().split(".")[1],r=e.toString().split(".")[1],n=0,a=0;if(0===t)return this.options.min;if(100===t)return this.options.max;h&&(n=i=h.length),r&&(n=s=r.length),i&&s&&(n=s<=i?i:s),o<0&&(o=+(o+(a=Math.abs(o))).toFixed(n),e=+(e+a).toFixed(n));var c,l=(e-o)/100*t+o,_=this.options.step.toString().split(".")[1];return l=_?+l.toFixed(_.length):(l/=this.options.step,+(l*=this.options.step).toFixed(0)),a&&(l-=a),(c=_?+l.toFixed(_.length):this.toFixed(l))<this.options.min?c=this.options.min:c>this.options.max&&(c=this.options.max),c},calcWithStep:function(t){var i=Math.round(t/this.coords.p_step)*this.coords.p_step;return 100<i&&(i=100),100===t&&(i=100),this.toFixed(i)},checkMinInterval:function(t,i,s){var o,e,h=this.options;return h.min_interval?(o=this.convertToValue(t),e=this.convertToValue(i),"from"===s?e-o<h.min_interval&&(o=e-h.min_interval):o-e<h.min_interval&&(o=e+h.min_interval),this.convertToPercent(o)):t},checkMaxInterval:function(t,i,s){var o,e,h=this.options;return h.max_interval?(o=this.convertToValue(t),e=this.convertToValue(i),"from"===s?e-o>h.max_interval&&(o=e-h.max_interval):o-e>h.max_interval&&(o=e+h.max_interval),this.convertToPercent(o)):t},checkDiapason:function(t,i,s){var o=this.convertToValue(t),e=this.options;return"number"!=typeof i&&(i=e.min),"number"!=typeof s&&(s=e.max),o<i&&(o=i),s<o&&(o=s),this.convertToPercent(o)},toFixed:function(t){return+(t=t.toFixed(20))},_prettify:function(t){return this.options.prettify_enabled?this.options.prettify&&"function"==typeof this.options.prettify?this.options.prettify(t):this.prettify(t):t},prettify:function(t){return t.toString().replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g,"$1"+this.options.prettify_separator)},checkEdges:function(t,i){return this.options.force_edges&&(t<0?t=0:100-i<t&&(t=100-i)),this.toFixed(t)},validate:function(){var t,i,s=this.options,o=this.result,e=s.values,h=e.length;if("string"==typeof s.min&&(s.min=+s.min),"string"==typeof s.max&&(s.max=+s.max),"string"==typeof s.from&&(s.from=+s.from),"string"==typeof s.to&&(s.to=+s.to),"string"==typeof s.step&&(s.step=+s.step),"string"==typeof s.from_min&&(s.from_min=+s.from_min),"string"==typeof s.from_max&&(s.from_max=+s.from_max),"string"==typeof s.to_min&&(s.to_min=+s.to_min),"string"==typeof s.to_max&&(s.to_max=+s.to_max),"string"==typeof s.grid_num&&(s.grid_num=+s.grid_num),s.max<s.min&&(s.max=s.min),h)for(s.p_values=[],s.min=0,s.max=h-1,s.step=1,s.grid_num=s.max,s.grid_snap=!0,i=0;i<h;i++)t=+e[i],t=isNaN(t)?e[i]:(e[i]=t,this._prettify(t)),s.p_values.push(t);("number"!=typeof s.from||isNaN(s.from))&&(s.from=s.min),("number"!=typeof s.to||isNaN(s.to))&&(s.to=s.max),"single"===s.type?(s.from<s.min&&(s.from=s.min),s.from>s.max&&(s.from=s.max)):(s.from<s.min&&(s.from=s.min),s.from>s.max&&(s.from=s.max),s.to<s.min&&(s.to=s.min),s.to>s.max&&(s.to=s.max),this.update_check.from&&(this.update_check.from!==s.from&&s.from>s.to&&(s.from=s.to),this.update_check.to!==s.to&&s.to<s.from&&(s.to=s.from)),s.from>s.to&&(s.from=s.to),s.to<s.from&&(s.to=s.from)),("number"!=typeof s.step||isNaN(s.step)||!s.step||s.step<0)&&(s.step=1),"number"==typeof s.from_min&&s.from<s.from_min&&(s.from=s.from_min),"number"==typeof s.from_max&&s.from>s.from_max&&(s.from=s.from_max),"number"==typeof s.to_min&&s.to<s.to_min&&(s.to=s.to_min),"number"==typeof s.to_max&&s.from>s.to_max&&(s.to=s.to_max),o&&(o.min!==s.min&&(o.min=s.min),o.max!==s.max&&(o.max=s.max),(o.from<o.min||o.from>o.max)&&(o.from=s.from),(o.to<o.min||o.to>o.max)&&(o.to=s.to)),("number"!=typeof s.min_interval||isNaN(s.min_interval)||!s.min_interval||s.min_interval<0)&&(s.min_interval=0),("number"!=typeof s.max_interval||isNaN(s.max_interval)||!s.max_interval||s.max_interval<0)&&(s.max_interval=0),s.min_interval&&s.min_interval>s.max-s.min&&(s.min_interval=s.max-s.min),s.max_interval&&s.max_interval>s.max-s.min&&(s.max_interval=s.max-s.min)},decorate:function(t,i){var s="",o=this.options;return o.prefix&&(s+=o.prefix),s+=t,o.max_postfix&&(o.values.length&&t===o.p_values[o.max]?(s+=o.max_postfix,o.postfix&&(s+=" ")):i===o.max&&(s+=o.max_postfix,o.postfix&&(s+=" "))),o.postfix&&(s+=o.postfix),s},updateFrom:function(){this.result.from=this.options.from,this.result.from_percent=this.convertToPercent(this.result.from),this.result.from_pretty=this._prettify(this.result.from),this.options.values&&(this.result.from_value=this.options.values[this.result.from])},updateTo:function(){this.result.to=this.options.to,this.result.to_percent=this.convertToPercent(this.result.to),this.result.to_pretty=this._prettify(this.result.to),this.options.values&&(this.result.to_value=this.options.values[this.result.to])},updateResult:function(){this.result.min=this.options.min,this.result.max=this.options.max,this.updateFrom(),this.updateTo()},appendGrid:function(){if(this.options.grid){var t,i,s,o,e,h,r=this.options,n=r.max-r.min,a=r.grid_num,c=0,l=4,_="";for(this.calcGridMargin(),r.grid_snap&&(a=n/r.step),50<a&&(a=50),s=this.toFixed(100/a),4<a&&(l=3),7<a&&(l=2),14<a&&(l=1),28<a&&(l=0),t=0;t<a+1;t++){for(o=l,100<(c=this.toFixed(s*t))&&(c=100),e=((this.coords.big[t]=c)-s*(t-1))/(o+1),i=1;i<=o&&0!==c;i++)_+='<span class="irs-grid-pol small" style="left: '+this.toFixed(c-e*i)+'%"></span>';_+='<span class="irs-grid-pol" style="left: '+c+'%"></span>',h=this.convertToValue(c),_+='<span class="irs-grid-text js-grid-text-'+t+'" style="left: '+c+'%">'+(h=r.values.length?r.p_values[h]:this._prettify(h))+"</span>"}this.coords.big_num=Math.ceil(a+1),this.$cache.cont.addClass("irs-with-grid"),this.$cache.grid.html(_),this.cacheGridLabels()}},cacheGridLabels:function(){var t,i,s=this.coords.big_num;for(i=0;i<s;i++)t=this.$cache.grid.find(".js-grid-text-"+i),this.$cache.grid_labels.push(t);this.calcGridLabels()},calcGridLabels:function(){var t,i,s=[],o=[],e=this.coords.big_num;for(t=0;t<e;t++)this.coords.big_w[t]=this.$cache.grid_labels[t].outerWidth(!1),this.coords.big_p[t]=this.toFixed(this.coords.big_w[t]/this.coords.w_rs*100),this.coords.big_x[t]=this.toFixed(this.coords.big_p[t]/2),s[t]=this.toFixed(this.coords.big[t]-this.coords.big_x[t]),o[t]=this.toFixed(s[t]+this.coords.big_p[t]);for(this.options.force_edges&&(s[0]<-this.coords.grid_gap&&(s[0]=-this.coords.grid_gap,o[0]=this.toFixed(s[0]+this.coords.big_p[0]),this.coords.big_x[0]=this.coords.grid_gap),o[e-1]>100+this.coords.grid_gap&&(o[e-1]=100+this.coords.grid_gap,s[e-1]=this.toFixed(o[e-1]-this.coords.big_p[e-1]),this.coords.big_x[e-1]=this.toFixed(this.coords.big_p[e-1]-this.coords.grid_gap))),this.calcGridCollision(2,s,o),this.calcGridCollision(4,s,o),t=0;t<e;t++)i=this.$cache.grid_labels[t][0],this.coords.big_x[t]!==Number.POSITIVE_INFINITY&&(i.style.marginLeft=-this.coords.big_x[t]+"%")},calcGridCollision:function(t,i,s){var o,e,h,r=this.coords.big_num;for(o=0;o<r&&!(r<=(e=o+t/2));o+=t)h=this.$cache.grid_labels[e][0],s[o]<=i[e]?h.style.visibility="visible":h.style.visibility="hidden"},calcGridMargin:function(){this.options.grid_margin&&(this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&("single"===this.options.type?this.coords.w_handle=this.$cache.s_single.outerWidth(!1):this.coords.w_handle=this.$cache.s_from.outerWidth(!1),this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100),this.coords.grid_gap=this.toFixed(this.coords.p_handle/2-.1),this.$cache.grid[0].style.width=this.toFixed(100-this.coords.p_handle)+"%",this.$cache.grid[0].style.left=this.coords.grid_gap+"%"))},update:function(t){this.input&&(this.is_update=!0,this.options.from=this.result.from,this.options.to=this.result.to,this.update_check.from=this.result.from,this.update_check.to=this.result.to,this.options=a.extend(this.options,t),this.validate(),this.updateResult(t),this.toggleInput(),this.remove(),this.init(!0))},reset:function(){this.input&&(this.updateResult(),this.update())},destroy:function(){this.input&&(this.toggleInput(),this.$cache.input.prop("readonly",!1),a.data(this.input,"ionRangeSlider",null),this.remove(),this.input=null,this.options=null)}},a.fn.ionRangeSlider=function(t){return this.each(function(){a.data(this,"ionRangeSlider")||a.data(this,"ionRangeSlider",new h(this,t,o++))})},function(){for(var h=0,t=["ms","moz","webkit","o"],i=0;i<t.length&&!l.requestAnimationFrame;++i)l.requestAnimationFrame=l[t[i]+"RequestAnimationFrame"],l.cancelAnimationFrame=l[t[i]+"CancelAnimationFrame"]||l[t[i]+"CancelRequestAnimationFrame"];l.requestAnimationFrame||(l.requestAnimationFrame=function(t,i){var s=(new Date).getTime(),o=Math.max(0,16-(s-h)),e=l.setTimeout(function(){t(s+o)},o);return h=s+o,e}),l.cancelAnimationFrame||(l.cancelAnimationFrame=function(t){clearTimeout(t)})}()});

"use strict";function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();(function(){var ImagePicker,ImagePickerOption,both_array_are_equal,sanitized_options,indexOf=[].indexOf;jQuery.fn.extend({imagepicker:function(){var opts=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return this.each(function(){var select;if((select=jQuery(this)).data("picker")&&select.data("picker").destroy(),select.data("picker",new ImagePicker(this,sanitized_options(opts))),null!=opts.initialized)return opts.initialized.call(select.data("picker"))})}}),sanitized_options=function(opts){var default_options;return default_options={hide_select:!0,show_label:!1,initialized:void 0,changed:void 0,clicked:void 0,selected:void 0,limit:void 0,limit_reached:void 0,font_awesome:!1},jQuery.extend(default_options,opts)},both_array_are_equal=function(a,b){var i,j,len,x;if(!a||!b||a.length!==b.length)return!1;for(a=a.slice(0),b=b.slice(0),a.sort(),b.sort(),i=j=0,len=a.length;j<len;i=++j)if(x=a[i],b[i]!==x)return!1;return!0},ImagePicker=function(){function ImagePicker(select_element){var opts1=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};_classCallCheck(this,ImagePicker),this.sync_picker_with_select=this.sync_picker_with_select.bind(this),this.opts=opts1,this.select=jQuery(select_element),this.multiple="multiple"===this.select.attr("multiple"),null!=this.select.data("limit")&&(this.opts.limit=parseInt(this.select.data("limit"))),this.build_and_append_picker()}return _createClass(ImagePicker,[{key:"destroy",value:function(){var j,len,ref;for(j=0,len=(ref=this.picker_options).length;j<len;j++)ref[j].destroy();return this.picker.remove(),this.select.off("change",this.sync_picker_with_select),this.select.removeData("picker"),this.select.show()}},{key:"build_and_append_picker",value:function(){return this.opts.hide_select&&this.select.hide(),this.select.on("change",this.sync_picker_with_select),null!=this.picker&&this.picker.remove(),this.create_picker(),this.select.after(this.picker),this.sync_picker_with_select()}},{key:"sync_picker_with_select",value:function(){var j,len,option,ref,results;for(results=[],j=0,len=(ref=this.picker_options).length;j<len;j++)(option=ref[j]).is_selected()?results.push(option.mark_as_selected()):results.push(option.unmark_as_selected());return results}},{key:"create_picker",value:function(){return this.picker=jQuery("<ul class='thumbnails image_picker_selector'></ul>"),this.picker_options=[],this.recursively_parse_option_groups(this.select,this.picker),this.picker}},{key:"recursively_parse_option_groups",value:function(scoped_dom,target_container){var container,j,k,len,len1,option,option_group,ref,ref1,results;for(j=0,len=(ref=scoped_dom.children("optgroup")).length;j<len;j++)option_group=ref[j],option_group=jQuery(option_group),(container=jQuery("<ul></ul>")).append(jQuery("<li class='group_title'>"+option_group.attr("label")+"</li>")),target_container.append(jQuery("<li class='group'>").append(container)),this.recursively_parse_option_groups(option_group,container);for(ref1=function(){var l,len1,ref1,results1;for(results1=[],l=0,len1=(ref1=scoped_dom.children("option")).length;l<len1;l++)option=ref1[l],results1.push(new ImagePickerOption(option,this,this.opts));return results1}.call(this),results=[],k=0,len1=ref1.length;k<len1;k++)option=ref1[k],this.picker_options.push(option),option.has_image()&&results.push(target_container.append(option.node));return results}},{key:"has_implicit_blanks",value:function(){var option;return function(){var j,len,ref,results;for(results=[],j=0,len=(ref=this.picker_options).length;j<len;j++)(option=ref[j]).is_blank()&&!option.has_image()&&results.push(option);return results}.call(this).length>0}},{key:"selected_values",value:function(){return this.multiple?this.select.val()||[]:[this.select.val()]}},{key:"toggle",value:function(imagepicker_option,original_event){var new_values,old_values,selected_value;if(old_values=this.selected_values(),selected_value=imagepicker_option.value().toString(),this.multiple?indexOf.call(this.selected_values(),selected_value)>=0?((new_values=this.selected_values()).splice(jQuery.inArray(selected_value,old_values),1),this.select.val([]),this.select.val(new_values)):null!=this.opts.limit&&this.selected_values().length>=this.opts.limit?null!=this.opts.limit_reached&&this.opts.limit_reached.call(this.select):this.select.val(this.selected_values().concat(selected_value)):this.has_implicit_blanks()&&imagepicker_option.is_selected()?this.select.val(""):this.select.val(selected_value),!both_array_are_equal(old_values,this.selected_values())&&(this.select.change(),null!=this.opts.changed))return this.opts.changed.call(this.select,old_values,this.selected_values(),original_event)}}]),ImagePicker}(),ImagePickerOption=function(){function ImagePickerOption(option_element,picker){var opts1=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};_classCallCheck(this,ImagePickerOption),this.clicked=this.clicked.bind(this),this.picker=picker,this.opts=opts1,this.option=jQuery(option_element),this.create_node()}return _createClass(ImagePickerOption,[{key:"destroy",value:function(){return this.node.find(".thumbnail").off("click",this.clicked)}},{key:"has_image",value:function(){return null!=this.option.data("img-src")}},{key:"is_blank",value:function(){return!(null!=this.value()&&""!==this.value())}},{key:"is_selected",value:function(){var select_value;return select_value=this.picker.select.val(),this.picker.multiple?jQuery.inArray(this.value(),select_value)>=0:this.value()===select_value}},{key:"mark_as_selected",value:function(){return this.node.find(".thumbnail").addClass("selected")}},{key:"unmark_as_selected",value:function(){return this.node.find(".thumbnail").removeClass("selected")}},{key:"value",value:function(){return this.option.val()}},{key:"label",value:function(){return this.option.data("img-label")?this.option.data("img-label"):this.option.text()}},{key:"clicked",value:function(event){if(this.picker.toggle(this,event),null!=this.opts.clicked&&this.opts.clicked.call(this.picker.select,this,event),null!=this.opts.selected&&this.is_selected())return this.opts.selected.call(this.picker.select,this,event)}},{key:"create_node",value:function(){var image,imgAlt,imgClass,thumbnail;return this.node=jQuery("<li/>"),this.option.data("font_awesome")?(image=jQuery("<i>")).attr("class","fa-fw "+this.option.data("img-src")):(image=jQuery("<img class='image_picker_image'/>")).attr("src",this.option.data("img-src")),thumbnail=jQuery("<div class='thumbnail'>"),(imgClass=this.option.data("img-class"))&&(this.node.addClass(imgClass),image.addClass(imgClass),thumbnail.addClass(imgClass)),(imgAlt=this.option.data("img-alt"))&&image.attr("alt",imgAlt),thumbnail.on("click",this.clicked),thumbnail.append(image),this.opts.show_label&&thumbnail.append(jQuery("<p/>").html(this.label())),this.node.append(thumbnail),this.node}}]),ImagePickerOption}()}).call(void 0);

/*! jQuery Validation Plugin - v1.19.0 - 11/28/2018
 * https://jqueryvalidation.org/
 * Copyright (c) 2018 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof module&&module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){a.extend(a.fn,{validate:function(b){if(!this.length)return void(b&&b.debug&&window.console&&console.warn("Nothing selected, can't validate, returning nothing."));var c=a.data(this[0],"validator");return c?c:(this.attr("novalidate","novalidate"),c=new a.validator(b,this[0]),a.data(this[0],"validator",c),c.settings.onsubmit&&(this.on("click.validate",":submit",function(b){c.submitButton=b.currentTarget,a(this).hasClass("cancel")&&(c.cancelSubmit=!0),void 0!==a(this).attr("formnovalidate")&&(c.cancelSubmit=!0)}),this.on("submit.validate",function(b){function d(){var d,e;return c.submitButton&&(c.settings.submitHandler||c.formSubmitted)&&(d=a("<input type='hidden'/>").attr("name",c.submitButton.name).val(a(c.submitButton).val()).appendTo(c.currentForm)),!(c.settings.submitHandler&&!c.settings.debug)||(e=c.settings.submitHandler.call(c,c.currentForm,b),d&&d.remove(),void 0!==e&&e)}return c.settings.debug&&b.preventDefault(),c.cancelSubmit?(c.cancelSubmit=!1,d()):c.form()?c.pendingRequest?(c.formSubmitted=!0,!1):d():(c.focusInvalid(),!1)})),c)},valid:function(){var b,c,d;return a(this[0]).is("form")?b=this.validate().form():(d=[],b=!0,c=a(this[0].form).validate(),this.each(function(){b=c.element(this)&&b,b||(d=d.concat(c.errorList))}),c.errorList=d),b},rules:function(b,c){var d,e,f,g,h,i,j=this[0],k="undefined"!=typeof this.attr("contenteditable")&&"false"!==this.attr("contenteditable");if(null!=j&&(!j.form&&k&&(j.form=this.closest("form")[0],j.name=this.attr("name")),null!=j.form)){if(b)switch(d=a.data(j.form,"validator").settings,e=d.rules,f=a.validator.staticRules(j),b){case"add":a.extend(f,a.validator.normalizeRule(c)),delete f.messages,e[j.name]=f,c.messages&&(d.messages[j.name]=a.extend(d.messages[j.name],c.messages));break;case"remove":return c?(i={},a.each(c.split(/\s/),function(a,b){i[b]=f[b],delete f[b]}),i):(delete e[j.name],f)}return g=a.validator.normalizeRules(a.extend({},a.validator.classRules(j),a.validator.attributeRules(j),a.validator.dataRules(j),a.validator.staticRules(j)),j),g.required&&(h=g.required,delete g.required,g=a.extend({required:h},g)),g.remote&&(h=g.remote,delete g.remote,g=a.extend(g,{remote:h})),g}}}),a.extend(a.expr.pseudos||a.expr[":"],{blank:function(b){return!a.trim(""+a(b).val())},filled:function(b){var c=a(b).val();return null!==c&&!!a.trim(""+c)},unchecked:function(b){return!a(b).prop("checked")}}),a.validator=function(b,c){this.settings=a.extend(!0,{},a.validator.defaults,b),this.currentForm=c,this.init()},a.validator.format=function(b,c){return 1===arguments.length?function(){var c=a.makeArray(arguments);return c.unshift(b),a.validator.format.apply(this,c)}:void 0===c?b:(arguments.length>2&&c.constructor!==Array&&(c=a.makeArray(arguments).slice(1)),c.constructor!==Array&&(c=[c]),a.each(c,function(a,c){b=b.replace(new RegExp("\\{"+a+"\\}","g"),function(){return c})}),b)},a.extend(a.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",pendingClass:"pending",validClass:"valid",errorElement:"label",focusCleanup:!1,focusInvalid:!0,errorContainer:a([]),errorLabelContainer:a([]),onsubmit:!0,ignore:":hidden",ignoreTitle:!1,onfocusin:function(a){this.lastActive=a,this.settings.focusCleanup&&(this.settings.unhighlight&&this.settings.unhighlight.call(this,a,this.settings.errorClass,this.settings.validClass),this.hideThese(this.errorsFor(a)))},onfocusout:function(a){this.checkable(a)||!(a.name in this.submitted)&&this.optional(a)||this.element(a)},onkeyup:function(b,c){var d=[16,17,18,20,35,36,37,38,39,40,45,144,225];9===c.which&&""===this.elementValue(b)||a.inArray(c.keyCode,d)!==-1||(b.name in this.submitted||b.name in this.invalid)&&this.element(b)},onclick:function(a){a.name in this.submitted?this.element(a):a.parentNode.name in this.submitted&&this.element(a.parentNode)},highlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).addClass(c).removeClass(d):a(b).addClass(c).removeClass(d)},unhighlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).removeClass(c).addClass(d):a(b).removeClass(c).addClass(d)}},setDefaults:function(b){a.extend(a.validator.defaults,b)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"Please enter a valid email address.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date (ISO).",number:"Please enter a valid number.",digits:"Please enter only digits.",equalTo:"Please enter the same value again.",maxlength:a.validator.format("Please enter no more than {0} characters."),minlength:a.validator.format("Please enter at least {0} characters."),rangelength:a.validator.format("Please enter a value between {0} and {1} characters long."),range:a.validator.format("Please enter a value between {0} and {1}."),max:a.validator.format("Please enter a value less than or equal to {0}."),min:a.validator.format("Please enter a value greater than or equal to {0}."),step:a.validator.format("Please enter a multiple of {0}.")},autoCreateRanges:!1,prototype:{init:function(){function b(b){var c="undefined"!=typeof a(this).attr("contenteditable")&&"false"!==a(this).attr("contenteditable");if(!this.form&&c&&(this.form=a(this).closest("form")[0],this.name=a(this).attr("name")),d===this.form){var e=a.data(this.form,"validator"),f="on"+b.type.replace(/^validate/,""),g=e.settings;g[f]&&!a(this).is(g.ignore)&&g[f].call(e,this,b)}}this.labelContainer=a(this.settings.errorLabelContainer),this.errorContext=this.labelContainer.length&&this.labelContainer||a(this.currentForm),this.containers=a(this.settings.errorContainer).add(this.settings.errorLabelContainer),this.submitted={},this.valueCache={},this.pendingRequest=0,this.pending={},this.invalid={},this.reset();var c,d=this.currentForm,e=this.groups={};a.each(this.settings.groups,function(b,c){"string"==typeof c&&(c=c.split(/\s/)),a.each(c,function(a,c){e[c]=b})}),c=this.settings.rules,a.each(c,function(b,d){c[b]=a.validator.normalizeRule(d)}),a(this.currentForm).on("focusin.validate focusout.validate keyup.validate",":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], [type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox'], [contenteditable], [type='button']",b).on("click.validate","select, option, [type='radio'], [type='checkbox']",b),this.settings.invalidHandler&&a(this.currentForm).on("invalid-form.validate",this.settings.invalidHandler)},form:function(){return this.checkForm(),a.extend(this.submitted,this.errorMap),this.invalid=a.extend({},this.errorMap),this.valid()||a(this.currentForm).triggerHandler("invalid-form",[this]),this.showErrors(),this.valid()},checkForm:function(){this.prepareForm();for(var a=0,b=this.currentElements=this.elements();b[a];a++)this.check(b[a]);return this.valid()},element:function(b){var c,d,e=this.clean(b),f=this.validationTargetFor(e),g=this,h=!0;return void 0===f?delete this.invalid[e.name]:(this.prepareElement(f),this.currentElements=a(f),d=this.groups[f.name],d&&a.each(this.groups,function(a,b){b===d&&a!==f.name&&(e=g.validationTargetFor(g.clean(g.findByName(a))),e&&e.name in g.invalid&&(g.currentElements.push(e),h=g.check(e)&&h))}),c=this.check(f)!==!1,h=h&&c,c?this.invalid[f.name]=!1:this.invalid[f.name]=!0,this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers)),this.showErrors(),a(b).attr("aria-invalid",!c)),h},showErrors:function(b){if(b){var c=this;a.extend(this.errorMap,b),this.errorList=a.map(this.errorMap,function(a,b){return{message:a,element:c.findByName(b)[0]}}),this.successList=a.grep(this.successList,function(a){return!(a.name in b)})}this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){a.fn.resetForm&&a(this.currentForm).resetForm(),this.invalid={},this.submitted={},this.prepareForm(),this.hideErrors();var b=this.elements().removeData("previousValue").removeAttr("aria-invalid");this.resetElements(b)},resetElements:function(a){var b;if(this.settings.unhighlight)for(b=0;a[b];b++)this.settings.unhighlight.call(this,a[b],this.settings.errorClass,""),this.findByName(a[b].name).removeClass(this.settings.validClass);else a.removeClass(this.settings.errorClass).removeClass(this.settings.validClass)},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(a){var b,c=0;for(b in a)void 0!==a[b]&&null!==a[b]&&a[b]!==!1&&c++;return c},hideErrors:function(){this.hideThese(this.toHide)},hideThese:function(a){a.not(this.containers).text(""),this.addWrapper(a).hide()},valid:function(){return 0===this.size()},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{a(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(b){}},findLastActive:function(){var b=this.lastActive;return b&&1===a.grep(this.errorList,function(a){return a.element.name===b.name}).length&&b},elements:function(){var b=this,c={};return a(this.currentForm).find("input, select, textarea, [contenteditable]").not(":submit, :reset, :image, :disabled").not(this.settings.ignore).filter(function(){var d=this.name||a(this).attr("name"),e="undefined"!=typeof a(this).attr("contenteditable")&&"false"!==a(this).attr("contenteditable");return!d&&b.settings.debug&&window.console&&console.error("%o has no name assigned",this),e&&(this.form=a(this).closest("form")[0],this.name=d),this.form===b.currentForm&&(!(d in c||!b.objectLength(a(this).rules()))&&(c[d]=!0,!0))})},clean:function(b){return a(b)[0]},errors:function(){var b=this.settings.errorClass.split(" ").join(".");return a(this.settings.errorElement+"."+b,this.errorContext)},resetInternals:function(){this.successList=[],this.errorList=[],this.errorMap={},this.toShow=a([]),this.toHide=a([])},reset:function(){this.resetInternals(),this.currentElements=a([])},prepareForm:function(){this.reset(),this.toHide=this.errors().add(this.containers)},prepareElement:function(a){this.reset(),this.toHide=this.errorsFor(a)},elementValue:function(b){var c,d,e=a(b),f=b.type,g="undefined"!=typeof e.attr("contenteditable")&&"false"!==e.attr("contenteditable");return"radio"===f||"checkbox"===f?this.findByName(b.name).filter(":checked").val():"number"===f&&"undefined"!=typeof b.validity?b.validity.badInput?"NaN":e.val():(c=g?e.text():e.val(),"file"===f?"C:\\fakepath\\"===c.substr(0,12)?c.substr(12):(d=c.lastIndexOf("/"),d>=0?c.substr(d+1):(d=c.lastIndexOf("\\"),d>=0?c.substr(d+1):c)):"string"==typeof c?c.replace(/\r/g,""):c)},check:function(b){b=this.validationTargetFor(this.clean(b));var c,d,e,f,g=a(b).rules(),h=a.map(g,function(a,b){return b}).length,i=!1,j=this.elementValue(b);"function"==typeof g.normalizer?f=g.normalizer:"function"==typeof this.settings.normalizer&&(f=this.settings.normalizer),f&&(j=f.call(b,j),delete g.normalizer);for(d in g){e={method:d,parameters:g[d]};try{if(c=a.validator.methods[d].call(this,j,b,e.parameters),"dependency-mismatch"===c&&1===h){i=!0;continue}if(i=!1,"pending"===c)return void(this.toHide=this.toHide.not(this.errorsFor(b)));if(!c)return this.formatAndAdd(b,e),!1}catch(k){throw this.settings.debug&&window.console&&console.log("Exception occurred when checking element "+b.id+", check the '"+e.method+"' method.",k),k instanceof TypeError&&(k.message+=".  Exception occurred when checking element "+b.id+", check the '"+e.method+"' method."),k}}if(!i)return this.objectLength(g)&&this.successList.push(b),!0},customDataMessage:function(b,c){return a(b).data("msg"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase())||a(b).data("msg")},customMessage:function(a,b){var c=this.settings.messages[a];return c&&(c.constructor===String?c:c[b])},findDefined:function(){for(var a=0;a<arguments.length;a++)if(void 0!==arguments[a])return arguments[a]},defaultMessage:function(b,c){"string"==typeof c&&(c={method:c});var d=this.findDefined(this.customMessage(b.name,c.method),this.customDataMessage(b,c.method),!this.settings.ignoreTitle&&b.title||void 0,a.validator.messages[c.method],"<strong>Warning: No message defined for "+b.name+"</strong>"),e=/\$?\{(\d+)\}/g;return"function"==typeof d?d=d.call(this,c.parameters,b):e.test(d)&&(d=a.validator.format(d.replace(e,"{$1}"),c.parameters)),d},formatAndAdd:function(a,b){var c=this.defaultMessage(a,b);this.errorList.push({message:c,element:a,method:b.method}),this.errorMap[a.name]=c,this.submitted[a.name]=c},addWrapper:function(a){return this.settings.wrapper&&(a=a.add(a.parent(this.settings.wrapper))),a},defaultShowErrors:function(){var a,b,c;for(a=0;this.errorList[a];a++)c=this.errorList[a],this.settings.highlight&&this.settings.highlight.call(this,c.element,this.settings.errorClass,this.settings.validClass),this.showLabel(c.element,c.message);if(this.errorList.length&&(this.toShow=this.toShow.add(this.containers)),this.settings.success)for(a=0;this.successList[a];a++)this.showLabel(this.successList[a]);if(this.settings.unhighlight)for(a=0,b=this.validElements();b[a];a++)this.settings.unhighlight.call(this,b[a],this.settings.errorClass,this.settings.validClass);this.toHide=this.toHide.not(this.toShow),this.hideErrors(),this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return a(this.errorList).map(function(){return this.element})},showLabel:function(b,c){var d,e,f,g,h=this.errorsFor(b),i=this.idOrName(b),j=a(b).attr("aria-describedby");h.length?(h.removeClass(this.settings.validClass).addClass(this.settings.errorClass),h.html(c)):(h=a("<"+this.settings.errorElement+">").attr("id",i+"-error").addClass(this.settings.errorClass).html(c||""),d=h,this.settings.wrapper&&(d=h.hide().show().wrap("<"+this.settings.wrapper+"/>").parent()),this.labelContainer.length?this.labelContainer.append(d):this.settings.errorPlacement?this.settings.errorPlacement.call(this,d,a(b)):d.insertAfter(b),h.is("label")?h.attr("for",i):0===h.parents("label[for='"+this.escapeCssMeta(i)+"']").length&&(f=h.attr("id"),j?j.match(new RegExp("\\b"+this.escapeCssMeta(f)+"\\b"))||(j+=" "+f):j=f,a(b).attr("aria-describedby",j),e=this.groups[b.name],e&&(g=this,a.each(g.groups,function(b,c){c===e&&a("[name='"+g.escapeCssMeta(b)+"']",g.currentForm).attr("aria-describedby",h.attr("id"))})))),!c&&this.settings.success&&(h.text(""),"string"==typeof this.settings.success?h.addClass(this.settings.success):this.settings.success(h,b)),this.toShow=this.toShow.add(h)},errorsFor:function(b){var c=this.escapeCssMeta(this.idOrName(b)),d=a(b).attr("aria-describedby"),e="label[for='"+c+"'], label[for='"+c+"'] *";return d&&(e=e+", #"+this.escapeCssMeta(d).replace(/\s+/g,", #")),this.errors().filter(e)},escapeCssMeta:function(a){return a.replace(/([\\!"#$%&'()*+,.\/:;<=>?@\[\]^`{|}~])/g,"\\$1")},idOrName:function(a){return this.groups[a.name]||(this.checkable(a)?a.name:a.id||a.name)},validationTargetFor:function(b){return this.checkable(b)&&(b=this.findByName(b.name)),a(b).not(this.settings.ignore)[0]},checkable:function(a){return/radio|checkbox/i.test(a.type)},findByName:function(b){return a(this.currentForm).find("[name='"+this.escapeCssMeta(b)+"']")},getLength:function(b,c){switch(c.nodeName.toLowerCase()){case"select":return a("option:selected",c).length;case"input":if(this.checkable(c))return this.findByName(c.name).filter(":checked").length}return b.length},depend:function(a,b){return!this.dependTypes[typeof a]||this.dependTypes[typeof a](a,b)},dependTypes:{"boolean":function(a){return a},string:function(b,c){return!!a(b,c.form).length},"function":function(a,b){return a(b)}},optional:function(b){var c=this.elementValue(b);return!a.validator.methods.required.call(this,c,b)&&"dependency-mismatch"},startRequest:function(b){this.pending[b.name]||(this.pendingRequest++,a(b).addClass(this.settings.pendingClass),this.pending[b.name]=!0)},stopRequest:function(b,c){this.pendingRequest--,this.pendingRequest<0&&(this.pendingRequest=0),delete this.pending[b.name],a(b).removeClass(this.settings.pendingClass),c&&0===this.pendingRequest&&this.formSubmitted&&this.form()?(a(this.currentForm).submit(),this.submitButton&&a("input:hidden[name='"+this.submitButton.name+"']",this.currentForm).remove(),this.formSubmitted=!1):!c&&0===this.pendingRequest&&this.formSubmitted&&(a(this.currentForm).triggerHandler("invalid-form",[this]),this.formSubmitted=!1)},previousValue:function(b,c){return c="string"==typeof c&&c||"remote",a.data(b,"previousValue")||a.data(b,"previousValue",{old:null,valid:!0,message:this.defaultMessage(b,{method:c})})},destroy:function(){this.resetForm(),a(this.currentForm).off(".validate").removeData("validator").find(".validate-equalTo-blur").off(".validate-equalTo").removeClass("validate-equalTo-blur").find(".validate-lessThan-blur").off(".validate-lessThan").removeClass("validate-lessThan-blur").find(".validate-lessThanEqual-blur").off(".validate-lessThanEqual").removeClass("validate-lessThanEqual-blur").find(".validate-greaterThanEqual-blur").off(".validate-greaterThanEqual").removeClass("validate-greaterThanEqual-blur").find(".validate-greaterThan-blur").off(".validate-greaterThan").removeClass("validate-greaterThan-blur")}},classRuleSettings:{required:{required:!0},email:{email:!0},url:{url:!0},date:{date:!0},dateISO:{dateISO:!0},number:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0}},addClassRules:function(b,c){b.constructor===String?this.classRuleSettings[b]=c:a.extend(this.classRuleSettings,b)},classRules:function(b){var c={},d=a(b).attr("class");return d&&a.each(d.split(" "),function(){this in a.validator.classRuleSettings&&a.extend(c,a.validator.classRuleSettings[this])}),c},normalizeAttributeRule:function(a,b,c,d){/min|max|step/.test(c)&&(null===b||/number|range|text/.test(b))&&(d=Number(d),isNaN(d)&&(d=void 0)),d||0===d?a[c]=d:b===c&&"range"!==b&&(a[c]=!0)},attributeRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)"required"===c?(d=b.getAttribute(c),""===d&&(d=!0),d=!!d):d=f.attr(c),this.normalizeAttributeRule(e,g,c,d);return e.maxlength&&/-1|2147483647|524288/.test(e.maxlength)&&delete e.maxlength,e},dataRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)d=f.data("rule"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase()),""===d&&(d=!0),this.normalizeAttributeRule(e,g,c,d);return e},staticRules:function(b){var c={},d=a.data(b.form,"validator");return d.settings.rules&&(c=a.validator.normalizeRule(d.settings.rules[b.name])||{}),c},normalizeRules:function(b,c){return a.each(b,function(d,e){if(e===!1)return void delete b[d];if(e.param||e.depends){var f=!0;switch(typeof e.depends){case"string":f=!!a(e.depends,c.form).length;break;case"function":f=e.depends.call(c,c)}f?b[d]=void 0===e.param||e.param:(a.data(c.form,"validator").resetElements(a(c)),delete b[d])}}),a.each(b,function(d,e){b[d]=a.isFunction(e)&&"normalizer"!==d?e(c):e}),a.each(["minlength","maxlength"],function(){b[this]&&(b[this]=Number(b[this]))}),a.each(["rangelength","range"],function(){var c;b[this]&&(a.isArray(b[this])?b[this]=[Number(b[this][0]),Number(b[this][1])]:"string"==typeof b[this]&&(c=b[this].replace(/[\[\]]/g,"").split(/[\s,]+/),b[this]=[Number(c[0]),Number(c[1])]))}),a.validator.autoCreateRanges&&(null!=b.min&&null!=b.max&&(b.range=[b.min,b.max],delete b.min,delete b.max),null!=b.minlength&&null!=b.maxlength&&(b.rangelength=[b.minlength,b.maxlength],delete b.minlength,delete b.maxlength)),b},normalizeRule:function(b){if("string"==typeof b){var c={};a.each(b.split(/\s/),function(){c[this]=!0}),b=c}return b},addMethod:function(b,c,d){a.validator.methods[b]=c,a.validator.messages[b]=void 0!==d?d:a.validator.messages[b],c.length<3&&a.validator.addClassRules(b,a.validator.normalizeRule(b))},methods:{required:function(b,c,d){if(!this.depend(d,c))return"dependency-mismatch";if("select"===c.nodeName.toLowerCase()){var e=a(c).val();return e&&e.length>0}return this.checkable(c)?this.getLength(b,c)>0:void 0!==b&&null!==b&&b.length>0},email:function(a,b){return this.optional(b)||/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)},url:function(a,b){return this.optional(b)||/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[\/?#]\S*)?$/i.test(a)},date:function(){var a=!1;return function(b,c){return a||(a=!0,this.settings.debug&&window.console&&console.warn("The `date` method is deprecated and will be removed in version '2.0.0'.\nPlease don't use it, since it relies on the Date constructor, which\nbehaves very differently across browsers and locales. Use `dateISO`\ninstead or one of the locale specific methods in `localizations/`\nand `additional-methods.js`.")),this.optional(c)||!/Invalid|NaN/.test(new Date(b).toString())}}(),dateISO:function(a,b){return this.optional(b)||/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(a)},number:function(a,b){return this.optional(b)||/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)},digits:function(a,b){return this.optional(b)||/^\d+$/.test(a)},minlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d},maxlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e<=d},rangelength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d[0]&&e<=d[1]},min:function(a,b,c){return this.optional(b)||a>=c},max:function(a,b,c){return this.optional(b)||a<=c},range:function(a,b,c){return this.optional(b)||a>=c[0]&&a<=c[1]},step:function(b,c,d){var e,f=a(c).attr("type"),g="Step attribute on input type "+f+" is not supported.",h=["text","number","range"],i=new RegExp("\\b"+f+"\\b"),j=f&&!i.test(h.join()),k=function(a){var b=(""+a).match(/(?:\.(\d+))?$/);return b&&b[1]?b[1].length:0},l=function(a){return Math.round(a*Math.pow(10,e))},m=!0;if(j)throw new Error(g);return e=k(d),(k(b)>e||l(b)%l(d)!==0)&&(m=!1),this.optional(c)||m},equalTo:function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.not(".validate-equalTo-blur").length&&e.addClass("validate-equalTo-blur").on("blur.validate-equalTo",function(){a(c).valid()}),b===e.val()},remote:function(b,c,d,e){if(this.optional(c))return"dependency-mismatch";e="string"==typeof e&&e||"remote";var f,g,h,i=this.previousValue(c,e);return this.settings.messages[c.name]||(this.settings.messages[c.name]={}),i.originalMessage=i.originalMessage||this.settings.messages[c.name][e],this.settings.messages[c.name][e]=i.message,d="string"==typeof d&&{url:d}||d,h=a.param(a.extend({data:b},d.data)),i.old===h?i.valid:(i.old=h,f=this,this.startRequest(c),g={},g[c.name]=b,a.ajax(a.extend(!0,{mode:"abort",port:"validate"+c.name,dataType:"json",data:g,context:f.currentForm,success:function(a){var d,g,h,j=a===!0||"true"===a;f.settings.messages[c.name][e]=i.originalMessage,j?(h=f.formSubmitted,f.resetInternals(),f.toHide=f.errorsFor(c),f.formSubmitted=h,f.successList.push(c),f.invalid[c.name]=!1,f.showErrors()):(d={},g=a||f.defaultMessage(c,{method:e,parameters:b}),d[c.name]=i.message=g,f.invalid[c.name]=!0,f.showErrors(d)),i.valid=j,f.stopRequest(c,j)}},d)),"pending")}}});var b,c={};return a.ajaxPrefilter?a.ajaxPrefilter(function(a,b,d){var e=a.port;"abort"===a.mode&&(c[e]&&c[e].abort(),c[e]=d)}):(b=a.ajax,a.ajax=function(d){var e=("mode"in d?d:a.ajaxSettings).mode,f=("port"in d?d:a.ajaxSettings).port;return"abort"===e?(c[f]&&c[f].abort(),c[f]=b.apply(this,arguments),c[f]):b.apply(this,arguments)}),a});

/*! jQuery Validation Plugin - v1.19.0 - 11/28/2018
 * https://jqueryvalidation.org/
 * Copyright (c) 2018 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery","./jquery.validate.min"],a):"object"==typeof module&&module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){return function(){function b(a){return a.replace(/<.[^<>]*?>/g," ").replace(/&nbsp;|&#160;/gi," ").replace(/[.(),;:!?%#$'\"_+=\/\-“”’]*/g,"")}a.validator.addMethod("maxWords",function(a,c,d){return this.optional(c)||b(a).match(/\b\w+\b/g).length<=d},a.validator.format("Please enter {0} words or less.")),a.validator.addMethod("minWords",function(a,c,d){return this.optional(c)||b(a).match(/\b\w+\b/g).length>=d},a.validator.format("Please enter at least {0} words.")),a.validator.addMethod("rangeWords",function(a,c,d){var e=b(a),f=/\b\w+\b/g;return this.optional(c)||e.match(f).length>=d[0]&&e.match(f).length<=d[1]},a.validator.format("Please enter between {0} and {1} words."))}(),a.validator.addMethod("abaRoutingNumber",function(a){var b=0,c=a.split(""),d=c.length;if(9!==d)return!1;for(var e=0;e<d;e+=3)b+=3*parseInt(c[e],10)+7*parseInt(c[e+1],10)+parseInt(c[e+2],10);return 0!==b&&b%10===0},"Please enter a valid routing number."),a.validator.addMethod("accept",function(b,c,d){var e,f,g,h="string"==typeof d?d.replace(/\s/g,""):"image/*",i=this.optional(c);if(i)return i;if("file"===a(c).attr("type")&&(h=h.replace(/[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g,"\\$&").replace(/,/g,"|").replace(/\/\*/g,"/.*"),c.files&&c.files.length))for(g=new RegExp(".?("+h+")$","i"),e=0;e<c.files.length;e++)if(f=c.files[e],!f.type.match(g))return!1;return!0},a.validator.format("Please enter a value with a valid mimetype.")),a.validator.addMethod("alphanumeric",function(a,b){return this.optional(b)||/^\w+$/i.test(a)},"Letters, numbers, and underscores only please"),a.validator.addMethod("bankaccountNL",function(a,b){if(this.optional(b))return!0;if(!/^[0-9]{9}|([0-9]{2} ){3}[0-9]{3}$/.test(a))return!1;var c,d,e,f=a.replace(/ /g,""),g=0,h=f.length;for(c=0;c<h;c++)d=h-c,e=f.substring(c,c+1),g+=d*e;return g%11===0},"Please specify a valid bank account number"),a.validator.addMethod("bankorgiroaccountNL",function(b,c){return this.optional(c)||a.validator.methods.bankaccountNL.call(this,b,c)||a.validator.methods.giroaccountNL.call(this,b,c)},"Please specify a valid bank or giro account number"),a.validator.addMethod("bic",function(a,b){return this.optional(b)||/^([A-Z]{6}[A-Z2-9][A-NP-Z1-9])(X{3}|[A-WY-Z0-9][A-Z0-9]{2})?$/.test(a.toUpperCase())},"Please specify a valid BIC code"),a.validator.addMethod("cifES",function(a,b){"use strict";function c(a){return a%2===0}if(this.optional(b))return!0;var d,e,f,g,h=new RegExp(/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/gi),i=a.substring(0,1),j=a.substring(1,8),k=a.substring(8,9),l=0,m=0,n=0;if(9!==a.length||!h.test(a))return!1;for(d=0;d<j.length;d++)e=parseInt(j[d],10),c(d)?(e*=2,n+=e<10?e:e-9):m+=e;return l=m+n,f=(10-l.toString().substr(-1)).toString(),f=parseInt(f,10)>9?"0":f,g="JABCDEFGHI".substr(f,1).toString(),i.match(/[ABEH]/)?k===f:i.match(/[KPQS]/)?k===g:k===f||k===g},"Please specify a valid CIF number."),a.validator.addMethod("cnhBR",function(a){if(a=a.replace(/([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g,""),11!==a.length)return!1;var b,c,d,e,f,g,h=0,i=0;if(b=a.charAt(0),new Array(12).join(b)===a)return!1;for(e=0,f=9,g=0;e<9;++e,--f)h+=+(a.charAt(e)*f);for(c=h%11,c>=10&&(c=0,i=2),h=0,e=0,f=1,g=0;e<9;++e,++f)h+=+(a.charAt(e)*f);return d=h%11,d>=10?d=0:d-=i,String(c).concat(d)===a.substr(-2)},"Please specify a valid CNH number"),a.validator.addMethod("cnpjBR",function(a,b){"use strict";if(this.optional(b))return!0;if(a=a.replace(/[^\d]+/g,""),14!==a.length)return!1;if("00000000000000"===a||"11111111111111"===a||"22222222222222"===a||"33333333333333"===a||"44444444444444"===a||"55555555555555"===a||"66666666666666"===a||"77777777777777"===a||"88888888888888"===a||"99999999999999"===a)return!1;for(var c=a.length-2,d=a.substring(0,c),e=a.substring(c),f=0,g=c-7,h=c;h>=1;h--)f+=d.charAt(c-h)*g--,g<2&&(g=9);var i=f%11<2?0:11-f%11;if(i!==parseInt(e.charAt(0),10))return!1;c+=1,d=a.substring(0,c),f=0,g=c-7;for(var j=c;j>=1;j--)f+=d.charAt(c-j)*g--,g<2&&(g=9);return i=f%11<2?0:11-f%11,i===parseInt(e.charAt(1),10)},"Please specify a CNPJ value number"),a.validator.addMethod("cpfBR",function(a,b){"use strict";if(this.optional(b))return!0;if(a=a.replace(/([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g,""),11!==a.length)return!1;var c,d,e,f,g=0;if(c=parseInt(a.substring(9,10),10),d=parseInt(a.substring(10,11),10),e=function(a,b){var c=10*a%11;return 10!==c&&11!==c||(c=0),c===b},""===a||"00000000000"===a||"11111111111"===a||"22222222222"===a||"33333333333"===a||"44444444444"===a||"55555555555"===a||"66666666666"===a||"77777777777"===a||"88888888888"===a||"99999999999"===a)return!1;for(f=1;f<=9;f++)g+=parseInt(a.substring(f-1,f),10)*(11-f);if(e(g,c)){for(g=0,f=1;f<=10;f++)g+=parseInt(a.substring(f-1,f),10)*(12-f);return e(g,d)}return!1},"Please specify a valid CPF number"),a.validator.addMethod("creditcard",function(a,b){if(this.optional(b))return"dependency-mismatch";if(/[^0-9 \-]+/.test(a))return!1;var c,d,e=0,f=0,g=!1;if(a=a.replace(/\D/g,""),a.length<13||a.length>19)return!1;for(c=a.length-1;c>=0;c--)d=a.charAt(c),f=parseInt(d,10),g&&(f*=2)>9&&(f-=9),e+=f,g=!g;return e%10===0},"Please enter a valid credit card number."),a.validator.addMethod("creditcardtypes",function(a,b,c){if(/[^0-9\-]+/.test(a))return!1;a=a.replace(/\D/g,"");var d=0;return c.mastercard&&(d|=1),c.visa&&(d|=2),c.amex&&(d|=4),c.dinersclub&&(d|=8),c.enroute&&(d|=16),c.discover&&(d|=32),c.jcb&&(d|=64),c.unknown&&(d|=128),c.all&&(d=255),1&d&&(/^(5[12345])/.test(a)||/^(2[234567])/.test(a))?16===a.length:2&d&&/^(4)/.test(a)?16===a.length:4&d&&/^(3[47])/.test(a)?15===a.length:8&d&&/^(3(0[012345]|[68]))/.test(a)?14===a.length:16&d&&/^(2(014|149))/.test(a)?15===a.length:32&d&&/^(6011)/.test(a)?16===a.length:64&d&&/^(3)/.test(a)?16===a.length:64&d&&/^(2131|1800)/.test(a)?15===a.length:!!(128&d)},"Please enter a valid credit card number."),a.validator.addMethod("currency",function(a,b,c){var d,e="string"==typeof c,f=e?c:c[0],g=!!e||c[1];return f=f.replace(/,/g,""),f=g?f+"]":f+"]?",d="^["+f+"([1-9]{1}[0-9]{0,2}(\\,[0-9]{3})*(\\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\\.[0-9]{0,2})?|0(\\.[0-9]{0,2})?|(\\.[0-9]{1,2})?)$",d=new RegExp(d),this.optional(b)||d.test(a)},"Please specify a valid currency"),a.validator.addMethod("dateFA",function(a,b){return this.optional(b)||/^[1-4]\d{3}\/((0?[1-6]\/((3[0-1])|([1-2][0-9])|(0?[1-9])))|((1[0-2]|(0?[7-9]))\/(30|([1-2][0-9])|(0?[1-9]))))$/.test(a)},a.validator.messages.date),a.validator.addMethod("dateITA",function(a,b){var c,d,e,f,g,h=!1,i=/^\d{1,2}\/\d{1,2}\/\d{4}$/;return i.test(a)?(c=a.split("/"),d=parseInt(c[0],10),e=parseInt(c[1],10),f=parseInt(c[2],10),g=new Date(Date.UTC(f,e-1,d,12,0,0,0)),h=g.getUTCFullYear()===f&&g.getUTCMonth()===e-1&&g.getUTCDate()===d):h=!1,this.optional(b)||h},a.validator.messages.date),a.validator.addMethod("dateNL",function(a,b){return this.optional(b)||/^(0?[1-9]|[12]\d|3[01])[\.\/\-](0?[1-9]|1[012])[\.\/\-]([12]\d)?(\d\d)$/.test(a)},a.validator.messages.date),a.validator.addMethod("extension",function(a,b,c){return c="string"==typeof c?c.replace(/,/g,"|"):"png|jpe?g|gif",this.optional(b)||a.match(new RegExp("\\.("+c+")$","i"))},a.validator.format("Please enter a value with a valid extension.")),a.validator.addMethod("giroaccountNL",function(a,b){return this.optional(b)||/^[0-9]{1,7}$/.test(a)},"Please specify a valid giro account number"),a.validator.addMethod("greaterThan",function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.not(".validate-greaterThan-blur").length&&e.addClass("validate-greaterThan-blur").on("blur.validate-greaterThan",function(){a(c).valid()}),b>e.val()},"Please enter a greater value."),a.validator.addMethod("greaterThanEqual",function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.not(".validate-greaterThanEqual-blur").length&&e.addClass("validate-greaterThanEqual-blur").on("blur.validate-greaterThanEqual",function(){a(c).valid()}),b>=e.val()},"Please enter a greater value."),a.validator.addMethod("iban",function(a,b){if(this.optional(b))return!0;var c,d,e,f,g,h,i,j,k,l=a.replace(/ /g,"").toUpperCase(),m="",n=!0,o="",p="",q=5;if(l.length<q)return!1;if(c=l.substring(0,2),h={AL:"\\d{8}[\\dA-Z]{16}",AD:"\\d{8}[\\dA-Z]{12}",AT:"\\d{16}",AZ:"[\\dA-Z]{4}\\d{20}",BE:"\\d{12}",BH:"[A-Z]{4}[\\dA-Z]{14}",BA:"\\d{16}",BR:"\\d{23}[A-Z][\\dA-Z]",BG:"[A-Z]{4}\\d{6}[\\dA-Z]{8}",CR:"\\d{17}",HR:"\\d{17}",CY:"\\d{8}[\\dA-Z]{16}",CZ:"\\d{20}",DK:"\\d{14}",DO:"[A-Z]{4}\\d{20}",EE:"\\d{16}",FO:"\\d{14}",FI:"\\d{14}",FR:"\\d{10}[\\dA-Z]{11}\\d{2}",GE:"[\\dA-Z]{2}\\d{16}",DE:"\\d{18}",GI:"[A-Z]{4}[\\dA-Z]{15}",GR:"\\d{7}[\\dA-Z]{16}",GL:"\\d{14}",GT:"[\\dA-Z]{4}[\\dA-Z]{20}",HU:"\\d{24}",IS:"\\d{22}",IE:"[\\dA-Z]{4}\\d{14}",IL:"\\d{19}",IT:"[A-Z]\\d{10}[\\dA-Z]{12}",KZ:"\\d{3}[\\dA-Z]{13}",KW:"[A-Z]{4}[\\dA-Z]{22}",LV:"[A-Z]{4}[\\dA-Z]{13}",LB:"\\d{4}[\\dA-Z]{20}",LI:"\\d{5}[\\dA-Z]{12}",LT:"\\d{16}",LU:"\\d{3}[\\dA-Z]{13}",MK:"\\d{3}[\\dA-Z]{10}\\d{2}",MT:"[A-Z]{4}\\d{5}[\\dA-Z]{18}",MR:"\\d{23}",MU:"[A-Z]{4}\\d{19}[A-Z]{3}",MC:"\\d{10}[\\dA-Z]{11}\\d{2}",MD:"[\\dA-Z]{2}\\d{18}",ME:"\\d{18}",NL:"[A-Z]{4}\\d{10}",NO:"\\d{11}",PK:"[\\dA-Z]{4}\\d{16}",PS:"[\\dA-Z]{4}\\d{21}",PL:"\\d{24}",PT:"\\d{21}",RO:"[A-Z]{4}[\\dA-Z]{16}",SM:"[A-Z]\\d{10}[\\dA-Z]{12}",SA:"\\d{2}[\\dA-Z]{18}",RS:"\\d{18}",SK:"\\d{20}",SI:"\\d{15}",ES:"\\d{20}",SE:"\\d{20}",CH:"\\d{5}[\\dA-Z]{12}",TN:"\\d{20}",TR:"\\d{5}[\\dA-Z]{17}",AE:"\\d{3}\\d{16}",GB:"[A-Z]{4}\\d{14}",VG:"[\\dA-Z]{4}\\d{16}"},g=h[c],"undefined"!=typeof g&&(i=new RegExp("^[A-Z]{2}\\d{2}"+g+"$",""),!i.test(l)))return!1;for(d=l.substring(4,l.length)+l.substring(0,4),j=0;j<d.length;j++)e=d.charAt(j),"0"!==e&&(n=!1),n||(m+="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(e));for(k=0;k<m.length;k++)f=m.charAt(k),p=""+o+f,o=p%97;return 1===o},"Please specify a valid IBAN"),a.validator.addMethod("integer",function(a,b){return this.optional(b)||/^-?\d+$/.test(a)},"A positive or negative non-decimal number please"),a.validator.addMethod("ipv4",function(a,b){return this.optional(b)||/^(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)$/i.test(a)},"Please enter a valid IP v4 address."),a.validator.addMethod("ipv6",function(a,b){return this.optional(b)||/^((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))$/i.test(a)},"Please enter a valid IP v6 address."),a.validator.addMethod("lessThan",function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.not(".validate-lessThan-blur").length&&e.addClass("validate-lessThan-blur").on("blur.validate-lessThan",function(){a(c).valid()}),b<e.val()},"Please enter a lesser value."),a.validator.addMethod("lessThanEqual",function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.not(".validate-lessThanEqual-blur").length&&e.addClass("validate-lessThanEqual-blur").on("blur.validate-lessThanEqual",function(){a(c).valid()}),b<=e.val()},"Please enter a lesser value."),a.validator.addMethod("lettersonly",function(a,b){return this.optional(b)||/^[a-z]+$/i.test(a)},"Letters only please"),a.validator.addMethod("letterswithbasicpunc",function(a,b){return this.optional(b)||/^[a-z\-.,()'"\s]+$/i.test(a)},"Letters or punctuation only please"),a.validator.addMethod("maxfiles",function(b,c,d){return!!this.optional(c)||!("file"===a(c).attr("type")&&c.files&&c.files.length>d)},a.validator.format("Please select no more than {0} files.")),a.validator.addMethod("maxsize",function(b,c,d){if(this.optional(c))return!0;if("file"===a(c).attr("type")&&c.files&&c.files.length)for(var e=0;e<c.files.length;e++)if(c.files[e].size>d)return!1;return!0},a.validator.format("File size must not exceed {0} bytes each.")),a.validator.addMethod("maxsizetotal",function(b,c,d){if(this.optional(c))return!0;if("file"===a(c).attr("type")&&c.files&&c.files.length)for(var e=0,f=0;f<c.files.length;f++)if(e+=c.files[f].size,e>d)return!1;return!0},a.validator.format("Total size of all files must not exceed {0} bytes.")),a.validator.addMethod("mobileNL",function(a,b){return this.optional(b)||/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)6((\s|\s?\-\s?)?[0-9]){8}$/.test(a)},"Please specify a valid mobile number"),a.validator.addMethod("mobileRU",function(a,b){var c=a.replace(/\(|\)|\s+|-/g,"");return this.optional(b)||c.length>9&&/^((\+7|7|8)+([0-9]){10})$/.test(c)},"Please specify a valid mobile number"),a.validator.addMethod("mobileUK",function(a,b){return a=a.replace(/\(|\)|\s+|-/g,""),this.optional(b)||a.length>9&&a.match(/^(?:(?:(?:00\s?|\+)44\s?|0)7(?:[1345789]\d{2}|624)\s?\d{3}\s?\d{3})$/)},"Please specify a valid mobile number"),a.validator.addMethod("netmask",function(a,b){return this.optional(b)||/^(254|252|248|240|224|192|128)\.0\.0\.0|255\.(254|252|248|240|224|192|128|0)\.0\.0|255\.255\.(254|252|248|240|224|192|128|0)\.0|255\.255\.255\.(254|252|248|240|224|192|128|0)/i.test(a)},"Please enter a valid netmask."),a.validator.addMethod("nieES",function(a,b){"use strict";if(this.optional(b))return!0;var c,d=new RegExp(/^[MXYZ]{1}[0-9]{7,8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/gi),e="TRWAGMYFPDXBNJZSQVHLCKET",f=a.substr(a.length-1).toUpperCase();return a=a.toString().toUpperCase(),!(a.length>10||a.length<9||!d.test(a))&&(a=a.replace(/^[X]/,"0").replace(/^[Y]/,"1").replace(/^[Z]/,"2"),c=9===a.length?a.substr(0,8):a.substr(0,9),e.charAt(parseInt(c,10)%23)===f)},"Please specify a valid NIE number."),a.validator.addMethod("nifES",function(a,b){"use strict";return!!this.optional(b)||(a=a.toUpperCase(),!!a.match("((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)")&&(/^[0-9]{8}[A-Z]{1}$/.test(a)?"TRWAGMYFPDXBNJZSQVHLCKE".charAt(a.substring(8,0)%23)===a.charAt(8):!!/^[KLM]{1}/.test(a)&&a[8]==="TRWAGMYFPDXBNJZSQVHLCKE".charAt(a.substring(8,1)%23)))},"Please specify a valid NIF number."),a.validator.addMethod("nipPL",function(a){"use strict";if(a=a.replace(/[^0-9]/g,""),10!==a.length)return!1;for(var b=[6,5,7,2,3,4,5,6,7],c=0,d=0;d<9;d++)c+=b[d]*a[d];var e=c%11,f=10===e?0:e;return f===parseInt(a[9],10)},"Please specify a valid NIP number."),a.validator.addMethod("nisBR",function(a){var b,c,d,e,f,g=0;if(a=a.replace(/([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g,""),11!==a.length)return!1;for(c=parseInt(a.substring(10,11),10),b=parseInt(a.substring(0,10),10),e=2;e<12;e++)f=e,10===e&&(f=2),11===e&&(f=3),g+=b%10*f,b=parseInt(b/10,10);return d=g%11,d=d>1?11-d:0,c===d},"Please specify a valid NIS/PIS number"),a.validator.addMethod("notEqualTo",function(b,c,d){return this.optional(c)||!a.validator.methods.equalTo.call(this,b,c,d)},"Please enter a different value, values must not be the same."),a.validator.addMethod("nowhitespace",function(a,b){return this.optional(b)||/^\S+$/i.test(a)},"No white space please"),a.validator.addMethod("pattern",function(a,b,c){return!!this.optional(b)||("string"==typeof c&&(c=new RegExp("^(?:"+c+")$")),c.test(a))},"Invalid format."),a.validator.addMethod("phoneNL",function(a,b){return this.optional(b)||/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9]){8}$/.test(a)},"Please specify a valid phone number."),a.validator.addMethod("phonePL",function(a,b){a=a.replace(/\s+/g,"");var c=/^(?:(?:(?:\+|00)?48)|(?:\(\+?48\)))?(?:1[2-8]|2[2-69]|3[2-49]|4[1-68]|5[0-9]|6[0-35-9]|[7-8][1-9]|9[145])\d{7}$/;return this.optional(b)||c.test(a)},"Please specify a valid phone number"),a.validator.addMethod("phonesUK",function(a,b){return a=a.replace(/\(|\)|\s+|-/g,""),this.optional(b)||a.length>9&&a.match(/^(?:(?:(?:00\s?|\+)44\s?|0)(?:1\d{8,9}|[23]\d{9}|7(?:[1345789]\d{8}|624\d{6})))$/)},"Please specify a valid uk phone number"),a.validator.addMethod("phoneUK",function(a,b){return a=a.replace(/\(|\)|\s+|-/g,""),this.optional(b)||a.length>9&&a.match(/^(?:(?:(?:00\s?|\+)44\s?)|(?:\(?0))(?:\d{2}\)?\s?\d{4}\s?\d{4}|\d{3}\)?\s?\d{3}\s?\d{3,4}|\d{4}\)?\s?(?:\d{5}|\d{3}\s?\d{3})|\d{5}\)?\s?\d{4,5})$/)},"Please specify a valid phone number"),a.validator.addMethod("phoneUS",function(a,b){return a=a.replace(/\s+/g,""),this.optional(b)||a.length>9&&a.match(/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]\d{2}-?\d{4}$/)},"Please specify a valid phone number"),a.validator.addMethod("postalcodeBR",function(a,b){return this.optional(b)||/^\d{2}.\d{3}-\d{3}?$|^\d{5}-?\d{3}?$/.test(a)},"Informe um CEP válido."),a.validator.addMethod("postalCodeCA",function(a,b){return this.optional(b)||/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ] *\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i.test(a)},"Please specify a valid postal code"),a.validator.addMethod("postalcodeIT",function(a,b){return this.optional(b)||/^\d{5}$/.test(a)},"Please specify a valid postal code"),a.validator.addMethod("postalcodeNL",function(a,b){return this.optional(b)||/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/.test(a)},"Please specify a valid postal code"),a.validator.addMethod("postcodeUK",function(a,b){return this.optional(b)||/^((([A-PR-UWYZ][0-9])|([A-PR-UWYZ][0-9][0-9])|([A-PR-UWYZ][A-HK-Y][0-9])|([A-PR-UWYZ][A-HK-Y][0-9][0-9])|([A-PR-UWYZ][0-9][A-HJKSTUW])|([A-PR-UWYZ][A-HK-Y][0-9][ABEHMNPRVWXY]))\s?([0-9][ABD-HJLNP-UW-Z]{2})|(GIR)\s?(0AA))$/i.test(a)},"Please specify a valid UK postcode"),a.validator.addMethod("require_from_group",function(b,c,d){var e=a(d[1],c.form),f=e.eq(0),g=f.data("valid_req_grp")?f.data("valid_req_grp"):a.extend({},this),h=e.filter(function(){return g.elementValue(this)}).length>=d[0];return f.data("valid_req_grp",g),a(c).data("being_validated")||(e.data("being_validated",!0),e.each(function(){g.element(this)}),e.data("being_validated",!1)),h},a.validator.format("Please fill at least {0} of these fields.")),a.validator.addMethod("skip_or_fill_minimum",function(b,c,d){var e=a(d[1],c.form),f=e.eq(0),g=f.data("valid_skip")?f.data("valid_skip"):a.extend({},this),h=e.filter(function(){return g.elementValue(this)}).length,i=0===h||h>=d[0];return f.data("valid_skip",g),a(c).data("being_validated")||(e.data("being_validated",!0),e.each(function(){g.element(this)}),e.data("being_validated",!1)),i},a.validator.format("Please either skip these fields or fill at least {0} of them.")),a.validator.addMethod("stateUS",function(a,b,c){var d,e="undefined"==typeof c,f=!e&&"undefined"!=typeof c.caseSensitive&&c.caseSensitive,g=!e&&"undefined"!=typeof c.includeTerritories&&c.includeTerritories,h=!e&&"undefined"!=typeof c.includeMilitary&&c.includeMilitary;return d=g||h?g&&h?"^(A[AEKLPRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$":g?"^(A[KLRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$":"^(A[AEKLPRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$":"^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$",d=f?new RegExp(d):new RegExp(d,"i"),this.optional(b)||d.test(a)},"Please specify a valid state"),a.validator.addMethod("strippedminlength",function(b,c,d){return a(b).text().length>=d},a.validator.format("Please enter at least {0} characters")),a.validator.addMethod("time",function(a,b){return this.optional(b)||/^([01]\d|2[0-3]|[0-9])(:[0-5]\d){1,2}$/.test(a)},"Please enter a valid time, between 00:00 and 23:59"),a.validator.addMethod("time12h",function(a,b){return this.optional(b)||/^((0?[1-9]|1[012])(:[0-5]\d){1,2}(\ ?[AP]M))$/i.test(a)},"Please enter a valid time in 12-hour am/pm format"),a.validator.addMethod("url2",function(a,b){return this.optional(b)||/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(a)},a.validator.messages.url),a.validator.addMethod("vinUS",function(a){if(17!==a.length)return!1;var b,c,d,e,f,g,h=["A","B","C","D","E","F","G","H","J","K","L","M","N","P","R","S","T","U","V","W","X","Y","Z"],i=[1,2,3,4,5,6,7,8,1,2,3,4,5,7,9,2,3,4,5,6,7,8,9],j=[8,7,6,5,4,3,2,10,0,9,8,7,6,5,4,3,2],k=0;for(b=0;b<17;b++){if(e=j[b],d=a.slice(b,b+1),8===b&&(g=d),isNaN(d)){for(c=0;c<h.length;c++)if(d.toUpperCase()===h[c]){d=i[c],d*=e,isNaN(g)&&8===c&&(g=h[c]);break}}else d*=e;k+=d}return f=k%11,10===f&&(f="X"),f===g},"The specified vehicle identification number (VIN) is invalid."),a.validator.addMethod("zipcodeUS",function(a,b){return this.optional(b)||/^\d{5}(-\d{4})?$/.test(a)},"The specified US ZIP Code is invalid"),a.validator.addMethod("ziprange",function(a,b){return this.optional(b)||/^90[2-5]\d\{2\}-\d{4}$/.test(a)},"Your ZIP-code must be in the range 902xx-xxxx to 905xx-xxxx"),a});

//Tinymce
!function(){var a={},b=function(b){for(var c=a[b],e=c.deps,f=c.defn,g=e.length,h=new Array(g),i=0;i<g;++i)h[i]=d(e[i]);var j=f.apply(null,h);if(void 0===j)throw"module ["+b+"] returned undefined";c.instance=j},c=function(b,c,d){if("string"!=typeof b)throw"module id must be a string";if(void 0===c)throw"no dependencies for "+b;if(void 0===d)throw"no definition function for "+b;a[b]={deps:c,defn:d,instance:void 0}},d=function(c){var d=a[c];if(void 0===d)throw"module ["+c+"] was undefined";return void 0===d.instance&&b(c),d.instance},e=function(a,b){for(var c=a.length,e=new Array(c),f=0;f<c;++f)e[f]=d(a[f]);b.apply(null,e)},f={};f.bolt={module:{api:{define:c,require:e,demand:d}}};var g=c,h=function(a,b){g(a,[],function(){return b})};h("1",document),h("2",window),g("0",["1","2"],function(a,b){return function(c){var d,e,f,g,h,i=[];h=c?c:b,g=h.jQuery;var j=function(){return h.tinymce};g.fn.tinymce=function(c){var d,l,m,n=this,o="";if(!n.length)return n;if(!c)return j()?j().get(n[0].id):null;n.css("visibility","hidden");var p=function(){var a=[],b=0;f||(k(),f=!0),n.each(function(d,e){var f,g=e.id,h=c.oninit;g||(e.id=g=j().DOM.uniqueId()),j().get(g)||(f=j().createEditor(g,c),a.push(f),f.on("init",function(){var c,d=h;n.css("visibility",""),h&&++b==a.length&&("string"==typeof d&&(c=d.indexOf(".")===-1?null:j().resolve(d.replace(/\.\w+$/,"")),d=j().resolve(d)),d.apply(c||j(),a))}))}),g.each(a,function(a,b){b.render()})};if(h.tinymce||e||!(d=c.script_url))1===e?i.push(p):p();else{e=1,l=d.substring(0,d.lastIndexOf("/")),d.indexOf(".min")!=-1&&(o=".min"),h.tinymce=h.tinyMCEPreInit||{base:l,suffix:o},d.indexOf("gzip")!=-1&&(m=c.language||"en",d=d+(/\?/.test(d)?"&":"?")+"js=true&core=true&suffix="+escape(o)+"&themes="+escape(c.theme||"modern")+"&plugins="+escape(c.plugins||"")+"&languages="+(m||""),h.tinyMCE_GZ||(h.tinyMCE_GZ={start:function(){var a=function(a){j().ScriptLoader.markDone(j().baseURI.toAbsolute(a))};a("langs/"+m+".js"),a("themes/"+c.theme+"/theme"+o+".js"),a("themes/"+c.theme+"/langs/"+m+".js"),g.each(c.plugins.split(","),function(b,c){c&&(a("plugins/"+c+"/plugin"+o+".js"),a("plugins/"+c+"/langs/"+m+".js"))})},end:function(){}}));var q=a.createElement("script");q.type="text/javascript",q.onload=q.onreadystatechange=function(a){a=a||b.event,2===e||"load"!=a.type&&!/complete|loaded/.test(q.readyState)||(j().dom.Event.domLoaded=1,e=2,c.script_loaded&&c.script_loaded(),p(),g.each(i,function(a,b){b()}))},q.src=d,a.body.appendChild(q)}return n},g.extend(g.expr[":"],{tinymce:function(a){var b;return!!(a.id&&"tinymce"in h&&(b=j().get(a.id),b&&b.editorManager===j()))}});var k=function(){var a=function(a){"remove"===a&&this.each(function(a,b){var d=c(b);d&&d.remove()}),this.find("span.mceEditor,div.mceEditor").each(function(a,b){var c=j().get(b.id.replace(/_parent$/,""));c&&c.remove()})},b=function(b){var c,d=this;if(null!=b)a.call(d),d.each(function(a,c){var d;(d=j().get(c.id))&&d.setContent(b)});else if(d.length>0&&(c=j().get(d[0].id)))return c.getContent()},c=function(a){var b=null;return a&&a.id&&h.tinymce&&(b=j().get(a.id)),b},e=function(a){return!!(a&&a.length&&h.tinymce&&a.is(":tinymce"))},f={};g.each(["text","html","val"],function(a,h){var i=f[h]=g.fn[h],j="text"===h;g.fn[h]=function(a){var f=this;if(!e(f))return i.apply(f,arguments);if(a!==d)return b.call(f.filter(":tinymce"),a),i.apply(f.not(":tinymce"),arguments),f;var h="",k=arguments;return(j?f:f.eq(0)).each(function(a,b){var d=c(b);h+=d?j?d.getContent().replace(/<(?:"[^"]*"|'[^']*'|[^'">])*>/g,""):d.getContent({save:!0}):i.apply(g(b),k)}),h}}),g.each(["append","prepend"],function(a,b){var h=f[b]=g.fn[b],i="prepend"===b;g.fn[b]=function(a){var b=this;return e(b)?a!==d?("string"==typeof a&&b.filter(":tinymce").each(function(b,d){var e=c(d);e&&e.setContent(i?a+e.getContent():e.getContent()+a)}),h.apply(b.not(":tinymce"),arguments),b):void 0:h.apply(b,arguments)}}),g.each(["remove","replaceWith","replaceAll","empty"],function(b,c){var d=f[c]=g.fn[c];g.fn[c]=function(){return a.call(this,c),d.apply(this,arguments)}}),f.attr=g.fn.attr,g.fn.attr=function(a,h){var i=this,j=arguments;if(!a||"value"!==a||!e(i))return h!==d?f.attr.apply(i,j):f.attr.apply(i,j);if(h!==d)return b.call(i.filter(":tinymce"),h),f.attr.apply(i.not(":tinymce"),j),i;var k=i[0],l=c(k);return l?l.getContent({save:!0}):f.attr.apply(g(k),j)}}}}),d("0")()}();

// jQuery Mask Plugin v1.14.16
var $jscomp=$jscomp||{};$jscomp.scope={},$jscomp.findInternal=function(t,a,e){t instanceof String&&(t=String(t));for(var n=t.length,s=0;s<n;s++){var r=t[s];if(a.call(e,r,s,t))return{i:s,v:r}}return{i:-1,v:void 0}},$jscomp.ASSUME_ES5=!1,$jscomp.ASSUME_NO_NATIVE_MAP=!1,$jscomp.ASSUME_NO_NATIVE_SET=!1,$jscomp.SIMPLE_FROUND_POLYFILL=!1,$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(t,a,e){t!=Array.prototype&&t!=Object.prototype&&(t[a]=e.value)},$jscomp.getGlobal=function(t){return"undefined"!=typeof window&&window===t?t:"undefined"!=typeof global&&null!=global?global:t},$jscomp.global=$jscomp.getGlobal(this),$jscomp.polyfill=function(t,a,e,n){if(a){for(e=$jscomp.global,t=t.split("."),n=0;n<t.length-1;n++){var s=t[n];s in e||(e[s]={}),e=e[s]}(a=a(n=e[t=t[t.length-1]]))!=n&&null!=a&&$jscomp.defineProperty(e,t,{configurable:!0,writable:!0,value:a})}},$jscomp.polyfill("Array.prototype.find",function(t){return t||function(t,a){return $jscomp.findInternal(this,t,a).v}},"es6","es3"),function(t,a,e){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports&&"undefined"==typeof Meteor?module.exports=t(require("jquery")):t(a||e)}(function(t){var a=function(a,e,n){var s={invalid:[],getCaret:function(){try{var t=0,e=a.get(0),n=document.selection,r=e.selectionStart;if(n&&-1===navigator.appVersion.indexOf("MSIE 10")){var o=n.createRange();o.moveStart("character",-s.val().length),t=o.text.length}else(r||"0"===r)&&(t=r);return t}catch(t){}},setCaret:function(t){try{if(a.is(":focus")){var e=a.get(0);if(e.setSelectionRange)e.setSelectionRange(t,t);else{var n=e.createTextRange();n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",t),n.select()}}}catch(t){}},events:function(){a.on("keydown.mask",function(t){a.data("mask-keycode",t.keyCode||t.which),a.data("mask-previus-value",a.val()),a.data("mask-previus-caret-pos",s.getCaret()),s.maskDigitPosMapOld=s.maskDigitPosMap}).on(t.jMaskGlobals.useInput?"input.mask":"keyup.mask",s.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){a.keydown().keyup()},100)}).on("change.mask",function(){a.data("changed",!0)}).on("blur.mask",function(){i===s.val()||a.data("changed")||a.trigger("change"),a.data("changed",!1)}).on("blur.mask",function(){i=s.val()}).on("focus.mask",function(a){!0===n.selectOnFocus&&t(a.target).select()}).on("focusout.mask",function(){n.clearIfNotMatch&&!r.test(s.val())&&s.val("")})},getRegexMask:function(){for(var t,a,n,s,r=[],i=0;i<e.length;i++)(t=o.translation[e.charAt(i)])?(a=t.pattern.toString().replace(/.{1}$|^.{1}/g,""),n=t.optional,(t=t.recursive)?(r.push(e.charAt(i)),s={digit:e.charAt(i),pattern:a}):r.push(n||t?a+"?":a)):r.push(e.charAt(i).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));return r=r.join(""),s&&(r=r.replace(new RegExp("("+s.digit+"(.*"+s.digit+")?)"),"($1)?").replace(new RegExp(s.digit,"g"),s.pattern)),new RegExp(r)},destroyEvents:function(){a.off("input keydown keyup paste drop blur focusout ".split(" ").join(".mask "))},val:function(t){var e=a.is("input")?"val":"text";return 0<arguments.length?(a[e]()!==t&&a[e](t),e=a):e=a[e](),e},calculateCaretPosition:function(t){var e=s.getMasked(),n=s.getCaret();if(t!==e){var r=a.data("mask-previus-caret-pos")||0;e=e.length;var o,i=t.length,l=t=0,c=0,u=0;for(o=n;o<e&&s.maskDigitPosMap[o];o++)l++;for(o=n-1;0<=o&&s.maskDigitPosMap[o];o--)t++;for(o=n-1;0<=o;o--)s.maskDigitPosMap[o]&&c++;for(o=r-1;0<=o;o--)s.maskDigitPosMapOld[o]&&u++;n>i?n=10*e:r>=n&&r!==i?s.maskDigitPosMapOld[n]||(r=n,n=n-(u-c)-t,s.maskDigitPosMap[n]&&(n=r)):n>r&&(n=n+(c-u)+l)}return n},behaviour:function(e){e=e||window.event,s.invalid=[];var n=a.data("mask-keycode");if(-1===t.inArray(n,o.byPassKeys)){n=s.getMasked();var r=s.getCaret(),i=a.data("mask-previus-value")||"";return setTimeout(function(){s.setCaret(s.calculateCaretPosition(i))},t.jMaskGlobals.keyStrokeCompensation),s.val(n),s.setCaret(r),s.callbacks(e)}},getMasked:function(t,a){var r,i=[],l=void 0===a?s.val():a+"",c=0,u=e.length,p=0,f=l.length,d=1,v="push",k=-1,m=0;if(a=[],n.reverse){v="unshift",d=-1;var h=0;c=u-1,p=f-1;var g=function(){return-1<c&&-1<p}}else h=u-1,g=function(){return c<u&&p<f};for(;g();){var M=e.charAt(c),y=l.charAt(p),b=o.translation[M];b?(y.match(b.pattern)?(i[v](y),b.recursive&&(-1===k?k=c:c===h&&c!==k&&(c=k-d),h===k&&(c-=d)),c+=d):y===r?(m--,r=void 0):b.optional?(c+=d,p-=d):b.fallback?(i[v](b.fallback),c+=d,p-=d):s.invalid.push({p:p,v:y,e:b.pattern}),p+=d):(t||i[v](M),y===M?(a.push(p),p+=d):(r=M,a.push(p+m),m++),c+=d)}return t=e.charAt(h),u!==f+1||o.translation[t]||i.push(t),i=i.join(""),s.mapMaskdigitPositions(i,a,f),i},mapMaskdigitPositions:function(t,a,e){for(t=n.reverse?t.length-e:0,s.maskDigitPosMap={},e=0;e<a.length;e++)s.maskDigitPosMap[a[e]+t]=1},callbacks:function(t){var r=s.val(),o=r!==i,l=[r,t,a,n],c=function(t,a,e){"function"==typeof n[t]&&a&&n[t].apply(this,e)};c("onChange",!0===o,l),c("onKeyPress",!0===o,l),c("onComplete",r.length===e.length,l),c("onInvalid",0<s.invalid.length,[r,t,a,s.invalid,n])}};a=t(a);var r,o=this,i=s.val();e="function"==typeof e?e(s.val(),void 0,a,n):e,o.mask=e,o.options=n,o.remove=function(){var t=s.getCaret();return o.options.placeholder&&a.removeAttr("placeholder"),a.data("mask-maxlength")&&a.removeAttr("maxlength"),s.destroyEvents(),s.val(o.getCleanVal()),s.setCaret(t),a},o.getCleanVal=function(){return s.getMasked(!0)},o.getMaskedVal=function(t){return s.getMasked(!1,t)},o.init=function(i){if(i=i||!1,n=n||{},o.clearIfNotMatch=t.jMaskGlobals.clearIfNotMatch,o.byPassKeys=t.jMaskGlobals.byPassKeys,o.translation=t.extend({},t.jMaskGlobals.translation,n.translation),o=t.extend(!0,{},o,n),r=s.getRegexMask(),i)s.events(),s.val(s.getMasked());else{n.placeholder&&a.attr("placeholder",n.placeholder),a.data("mask")&&a.attr("autocomplete","off"),i=0;for(var l=!0;i<e.length;i++){var c=o.translation[e.charAt(i)];if(c&&c.recursive){l=!1;break}}l&&a.attr("maxlength",e.length).data("mask-maxlength",!0),s.destroyEvents(),s.events(),i=s.getCaret(),s.val(s.getMasked()),s.setCaret(i)}},o.init(!a.is("input"))};t.maskWatchers={};var e=function(){var e=t(this),s={},r=e.attr("data-mask");if(e.attr("data-mask-reverse")&&(s.reverse=!0),e.attr("data-mask-clearifnotmatch")&&(s.clearIfNotMatch=!0),"true"===e.attr("data-mask-selectonfocus")&&(s.selectOnFocus=!0),n(e,r,s))return e.data("mask",new a(this,r,s))},n=function(a,e,n){n=n||{};var s=t(a).data("mask"),r=JSON.stringify;a=t(a).val()||t(a).text();try{return"function"==typeof e&&(e=e(a)),"object"!=typeof s||r(s.options)!==r(n)||s.mask!==e}catch(t){}},s=function(t){var a=document.createElement("div"),e=(t="on"+t)in a;return e||(a.setAttribute(t,"return;"),e="function"==typeof a[t]),e};t.fn.mask=function(e,s){s=s||{};var r=this.selector,o=t.jMaskGlobals,i=o.watchInterval;o=s.watchInputs||o.watchInputs;var l=function(){if(n(this,e,s))return t(this).data("mask",new a(this,e,s))};return t(this).each(l),r&&""!==r&&o&&(clearInterval(t.maskWatchers[r]),t.maskWatchers[r]=setInterval(function(){t(document).find(r).each(l)},i)),this},t.fn.masked=function(t){return this.data("mask").getMaskedVal(t)},t.fn.unmask=function(){return clearInterval(t.maskWatchers[this.selector]),delete t.maskWatchers[this.selector],this.each(function(){var a=t(this).data("mask");a&&a.remove().removeData("mask")})},t.fn.cleanVal=function(){return this.data("mask").getCleanVal()},t.applyDataMask=function(a){((a=a||t.jMaskGlobals.maskElements)instanceof t?a:t(a)).filter(t.jMaskGlobals.dataMaskAttr).each(e)},s={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,keyStrokeCompensation:10,useInput:!/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent)&&s("input"),watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}}},t.jMaskGlobals=t.jMaskGlobals||{},(s=t.jMaskGlobals=t.extend(!0,{},s,t.jMaskGlobals)).dataMask&&t.applyDataMask(),setInterval(function(){t.jMaskGlobals.watchDataMask&&t.applyDataMask()},s.watchInterval)},window.jQuery,window.Zepto);

// Nice number
(function ($) { 
  $.fn.niceNumber = function(options) {
    var settings = $.extend({
      autoSize: true,
      autoSizeBuffer: 1,
      buttonDecrement: '-',
      buttonIncrement: "+",
      buttonPosition: 'around' 
    }, options); 

    return this.each(function(){
      var currentInput = this,
          $currentInput = $(currentInput),
          attrMax = null,
          attrMin = null;

      // Handle max and min values
      if (
        typeof $currentInput.attr('max') !== typeof undefined
        && $currentInput.attr('max') !== false
      ) {
        attrMax = parseFloat($currentInput.attr('max'));
      }

      if (
        typeof $currentInput.attr('min') !== typeof undefined
        && $currentInput.attr('min') !== false
      ) {
        attrMin = parseFloat($currentInput.attr('min'));
      }

      // Fix issue with initial value being < min
      if (
        attrMin
        && !currentInput.value
      ) {
        $currentInput.val(attrMin);
      }

      // Generate container
      var $inputContainer = $('<div/>',{
          class: 'nice-number'
        })
        .insertAfter(currentInput);

      // Generate interval (object so it is passed by reference)
      var interval = {};

      // Generate buttons
      var $minusButton = $('<button/>')
        .attr('type', 'button')
        .html(settings.buttonDecrement)
        .on('mousedown mouseup mouseleave', function(event){
          changeInterval(event.type, interval, function(){
            if (
              attrMin == null
              || attrMin < parseFloat(currentInput.value)
            ) {
              currentInput.value--;
            }
          });

          // Trigger the input event here to avoid event spam
          if (
            event.type == 'mouseup'
            || event.type == 'mouseleave'
          ) {
            $currentInput.trigger('input');
          }

          $currentInput.change();
        });

      var $plusButton = $('<button/>')
        .attr('type', 'button')
        .html(settings.buttonIncrement)
        .on('mousedown mouseup mouseleave', function(event){
          changeInterval(event.type, interval, function(){
            if (
              attrMax == null
              || attrMax > parseFloat(currentInput.value)
            ) {
              currentInput.value++;
            }
          });

          // Trigger the input event here to avoid event spam
          if (
            event.type == 'mouseup'
            || event.type == 'mouseleave'
          ) {
            $currentInput.trigger('input');
          }

          $currentInput.change();
        });

      // Append elements
      switch (settings.buttonPosition) {
        case 'left':
          $minusButton.appendTo($inputContainer);
          $plusButton.appendTo($inputContainer);
          $currentInput.appendTo($inputContainer);
          break;
        case 'right':
          $currentInput.appendTo($inputContainer);
          $minusButton.appendTo($inputContainer);
          $plusButton.appendTo($inputContainer);
          break;
        case 'around':
        default:
          $minusButton.appendTo($inputContainer);
          $currentInput.appendTo($inputContainer);
          $plusButton.appendTo($inputContainer);
          break;
      }

      // Nicely size input
      if (settings.autoSize) {
        $currentInput.width(
          $currentInput.val().length+settings.autoSizeBuffer+"ch"
        );
        $currentInput.on('keyup input',function(){
          $currentInput.animate({
            'width': $currentInput.val().length+settings.autoSizeBuffer+"ch"
          }, 200);
        });
      }
    });
  };

  function changeInterval(eventType, interval, callback) {
    if (eventType == "mousedown") {
      interval.timeout = setTimeout(function(){
        interval.actualInterval = setInterval(function(){
          callback();
        }, 100);
      }, 200);
      callback();
    } else {
      if (interval.timeout) {
        clearTimeout(interval.timeout);
      }
      if (interval.actualInterval) {
        clearInterval(interval.actualInterval);
      }
    }
  }
}(jQuery));

function parseFloatWithRemoveSepChar(text, separator_char, decimals_symbol) {
	if (typeof text === 'string') {
		if (typeof separator_char === 'string') {
			text = text.replaceAll(separator_char, "");
		}
		if (typeof decimals_symbol === 'string' && decimals_symbol !== '.') {
			text = text.replaceAll(decimals_symbol, ".");
		}
	}
	return parseFloat(text);
}

(function ($) {
	var WidgetPafeFormBuilderHandlerDate = function ($scope, $) {

        var $elements = $scope.find('.elementor-date-field');

		if (!$elements.length) {
			return;
		}

		var addDatePicker = function addDatePicker($element) {
			if ($($element).hasClass('elementor-use-native') || $($element).hasClass('flatpickr-custom-options')) { 
				return;
			}

			var minDate = $($element).attr('min') ? flatpickr.parseDate($($element).attr('min'), "Y-m-d") : null,
				maxDate = $($element).attr('max') ? flatpickr.parseDate($($element).attr('max'), "Y-m-d") : null;

			var options = {
				minDate: minDate,
				maxDate: maxDate,
				dateFormat: $($element).attr('data-date-format') || null,
				defaultDate: $($element).attr('data-pafe-form-builder-value') || null,
				allowInput: true,
				animate: false,
				onReady: function(date) { 
					var day = parseInt( date[0] / (1000 * 60 * 60 * 24), 10);
					$($element).attr('data-pafe-form-builder-date-calculate', day);
				},
				onClose: function(date) { 
					var day = parseInt( date[0] / (1000 * 60 * 60 * 24), 10);
					$($element).attr('data-pafe-form-builder-date-calculate', day);
				}
			};

			if ($($element).data('pafe-form-builder-date-range') != undefined) {
				var options = {
					minDate: minDate,
					maxDate: maxDate,
					dateFormat: $($element).attr('data-date-format') || null,
					defaultDate: $($element).attr('data-pafe-form-builder-value') || null,
					allowInput: true,
					animate: false,
					onClose: function(date) { 
						var startDay = flatpickr.formatDate(date[0], "m/d/Y");
						var endDay = flatpickr.formatDate(date[1], "m/d/Y");

						var newStartDate = new Date(startDay).getTime();
						var newEndDate = new Date(endDay).getTime();

						var newStartDate = eval( newStartDate / 1000 + 3600 ); // for GMT+1 I had to add 3600 (seconds) [1 hour]
						var newEndDate = eval( newEndDate / 1000 + 3600 ); // for GMT+1 I had to add 3600 (seconds) [1 hour]

						var countDays = eval( newEndDate - newStartDate );
						var countDays = eval( countDays / 86400 + 1 );

						$($element).attr('data-pafe-form-builder-date-range-days', countDays);
					}
				};

				options['mode'] = 'range';
			}

			if ($($element).data('pafe-form-builder-date-language') != 'english') { 
				options['locale'] = $($element).attr('data-pafe-form-builder-date-language');
			} 

			$element.flatpickr(options); 
		};

		$.each($elements, function (i, $element) {
			addDatePicker($element);
		});

    };

    var WidgetPafeFormBuilderHandlerTime = function ($scope, $) {

	    var $elements = $scope.find('.elementor-time-field');
	    var minute_increment = $elements.attr('data-time-minute-increment');

		if (!$elements.length) {
			return;
		}

		var addTimePicker = function addTimePicker($element) {
			if ($($element).hasClass('elementor-use-native')) {
				return;
			}

			var time_24hr = false;

			if ($($element).attr('data-pafe-form-builder-time-24hr') != undefined) {
				time_24hr = true;
			}

			$element.flatpickr({
				noCalendar: true,
				enableTime: true,
				allowInput: true,
				minuteIncrement: minute_increment,
				time_24hr: time_24hr,
				dateFormat: $($element).attr('data-time-format') || null,
				defaultDate: $($element).attr('data-pafe-form-builder-value') || null,
			});
		};
		$.each($elements, function (i, $element) {
			addTimePicker($element);
		});

	};

	var WidgetPafeFormBuilderHandlerImageSelect = function ($scope, $) {

	    var $elements = $scope.find('[data-pafe-form-builder-image-select]');

		if (!$elements.length) {
			return;
		}

		$.each($elements, function (i, $element) {
			
			var gallery = $($element).data('pafe-form-builder-image-select'),
                $options = $($element).find('option'),
                imagePickerOptions = {show_label: true};

            if ($($element).attr('data-pafe-form-builder-image-select-limit-multiple') != undefined) {
            	imagePickerOptions.limit = $($element).attr('data-pafe-form-builder-image-select-limit-multiple');
            }

            $($element).closest('.elementor-field').addClass('pafe-image-select-field');
			$($element).closest('.pafe-image-select-field').find('.image_picker_selector').remove();

            if ($options.eq(0).attr('value').trim() == '') {}
            
            $options.each(function(index,element){
            	if ($options.eq(0).attr('value').trim() == '' && index != 0) {
            		var indexGallery = index - 1;
	                var imageURL = gallery[indexGallery]['url'],
	                    optionsContent = $(this).html();

	                $(this).attr('data-img-src',imageURL);
	                $($element).imagepicker(imagePickerOptions);
	            }

	            if ($options.eq(0).attr('value').trim() != '') {
	            	if ( gallery[index] != undefined) { 
		                var imageURL = gallery[index]['url'],
		                    optionsContent = $(this).html();

		                $(this).attr('data-img-src',imageURL);
		                $($element).imagepicker(imagePickerOptions);
	                }
	            }

	            $($element).closest('.pafe-image-select-field').find('.thumbnail.selected').closest('li').addClass('disabled');
            });

		});

	};

	var WidgetPafeFormBuilderHandlerStripe = function ($scope, $) {

	    var $elements = $scope.find('[data-pafe-form-builder-stripe]');

		if (!$elements.length) {
			return;
		}

		$.each($elements, function (i, $element) {
			// Create a Stripe client
			var stripPk = $('[data-pafe-stripe]').data('pafe-stripe');

			if(typeof stripPk !== 'undefined') {

				var stripe = Stripe(stripPk);
				let stripeFontFamily = $(this).attr('data-pafe-form-builder-stripe-font-family');
				// Create an instance of Elements
				var elements = stripe.elements({
					fonts: [
						{
							cssSrc: stripeFontFamily,
						},
					]
				});

				// Custom styling can be passed to options when creating an Element.
				// (Note that this demo uses a wider set of styles than the guide below.)
				let customStyle = $(this).attr('data-pafe-form-stripe-custom-style');
				if(customStyle){
					var style = JSON.parse(customStyle);
				}else{
					let stripeStyle = $(this).attr('data-pafe-form-builder-stripe-style');
					stripeStyle = JSON.parse(stripeStyle);
					var style = {
						base: {
						  backgroundColor: stripeStyle.backgroundColor,
						  color: stripeStyle.color,
						  fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
						  fontSmoothing: 'antialiased',
						  fontSize: stripeStyle.fontSize,
						  '::placeholder': {
							color: stripeStyle.placeholderColor
						  }
						},
						invalid: {
						  color: '#fa755a',
						  iconColor: '#fa755a'
						}
					};
					if(stripeStyle.iconColor){
						style['base']['iconColor'] = stripeStyle.iconColor;
					}
				}
				// Create an instance of the card Element
				var card = elements.create('card', { style: style });

				// Add an instance of the card Element into the `card-element` <div>
				card.mount($element);

				var formIdStripe = $($element).data('pafe-form-builder-form-id');

			}

			$(document).on('click','[data-pafe-form-builder-submit-form-id][data-pafe-form-builder-stripe-submit]',function(){
				if ( $(this).data('pafe-form-builder-stripe-submit') != undefined ) {
			    	var formID = $(this).data('pafe-form-builder-submit-form-id'),
			    		$fields = $(document).find('[data-pafe-form-builder-form-id='+ formID +']'),
			    		requiredText = $(this).data('pafe-form-builder-required-text'),
			    		fieldsOj = [],
			    		error = 0,
			    		formData = new FormData();
                    
                    var isAlertRequired = false;
		    		var $submit = $(this);
					var $parent = $submit.closest('.elementor-element');

					$fields.each(function(){
						if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {

							var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
							var checked = 0;
							if ($checkboxRequired.length > 0) {
								checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
							}

							if ($(this).attr('oninvalid') != undefined) {
								requiredText = $(this).attr('oninvalid').replace("this.setCustomValidity('","").replace("')","");
							}
							//Check repassword
							if($(this).attr('data-pafe-is-repassword') != undefined && $(this).attr('data-pafe-is-repassword') != ''){
								var password_compare = $('[name="form_fields['+$(this).attr('data-pafe-is-repassword')+']"]').val();
								var password_msg = $(this).attr('data-pafe-repassword-msg');
								if(String(password_compare) !== String($(this).val())){
									this.setCustomValidity(password_msg);
									error++
									$(this).on('keyup', function(){								
										this.setCustomValidity("");
									})
								}else{
									this.setCustomValidity("");
								}
							}

							// Check confirm field
							if(typeof $(this).attr('data-pafe-confirm-field') !== 'undefined' && $(this).attr('data-pafe-confirm-field') !== false){
								let confirmValue = $('[name="form_fields['+$(this).attr('data-pafe-confirm-field')+']"]').val();
								let confirmMsg = $(this).attr('data-pafe-confirm-msg');
								if(String(confirmValue) !== String($(this).val())){
									this.setCustomValidity(confirmMsg);
									error++;
									$(this).on('keyup', function(){
										this.setCustomValidity("");
									})
								}else{
									this.setCustomValidity("");
								}
							}

							var isValid = $(this)[0].checkValidity();
							var next_ele = $($(this)[0]).next()[0];
							if ($(next_ele).hasClass('flatpickr-mobile')) {
								isValid = next_ele.checkValidity();
							}

							if ( !isValid && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).closest('[data-pafe-form-builder-conditional-logic]').css('display') != 'none' &&  $(this).closest('[data-pafe-signature]').length == 0 || checked == 0 && $checkboxRequired.length > 0 && $(this).closest('.elementor-element').css('display') != 'none') {
								if ($(this).css('display') == 'none' || $(this).data('pafe-form-builder-image-select') != undefined || $(this).data('pafe-form-builder-select-autocomplete') != undefined || $checkboxRequired.length > 0)  {
									$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
								} else {
									if (!isAlertRequired && $(this).data('pafe-form-builder-image-select') == undefined) {
										$(this)[0].reportValidity();
										isAlertRequired = true;
									}
								}
								error++;
							} else {
								if ($(this).val()=='' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('aria-required') == "true" && $(this).attr('data-pafe-form-builder-select-autocomplete') !== undefined) {
									$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
									error++;
								} else {

									if ( $(this).data('pafe-form-builder-image-select') != undefined ) {
										if ( $(this).closest('.pafe-image-select-field').find('.image_picker_selector').find('.selected').length < $(this).data('pafe-form-builder-image-select-min-select') ) {
											$(this).closest('.elementor-field-group').find('[data-pafe-image_select_min_select_check]').html($(this).data('pafe-form-builder-image-select-min-select-message'));
											error++;
										} else {
											$(this).closest('.elementor-field-group').find('[data-pafe-image_select_min_select_check]').remove();
										}
									}

									$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

                                    if ($(this).data('pafe-flatpickr-custom-options')!= undefined) {
                                        if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') != undefined) {
                                            $(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
                                            error++;
                                        }
                                    }

									if ($(this).closest('[data-pafe-signature]').length > 0) {
										var $pafeSingature = $(this).closest('[data-pafe-signature]'),
											$exportButton = $pafeSingature.find('[data-pafe-signature-export]');

										$exportButton.trigger('click');

										if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') == 'required') {
											$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
											error++;
										}
									}
									
									var fieldType = $(this).attr('type'),
										fieldName = $(this).attr('name');

									var $repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]'),
										repeaterID = '',
										repeaterIDOne = '',
										repeaterLabel = '',
										repeaterIndex = -1,
										repeaterLength = 0;

									if ($repeater.length > 0) {
										$repeaterParents = $(this).parents('[data-pafe-form-builder-repeater-form-id]');
										repeaterIDOne = $repeater.data('pafe-form-builder-repeater-id');
										$repeaterParents.each(function(){
											var repeaterParentID = $(this).data('pafe-form-builder-repeater-id'),
												$repeaterParentAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"][data-pafe-form-builder-repeater-id="' + repeaterParentID + '"]');

											repeaterParentIndex = $(this).index() - $repeaterParentAll.index();
											repeaterID += repeaterParentID + '|index' + repeaterParentIndex + '|' + fieldName.replace('[]','').replace('form_fields[','').replace(']','') + ',';
										});

										repeaterLabel = $repeater.data('pafe-form-builder-repeater-label');

										var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]');
										repeaterLength = $repeater.siblings('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]').length + 1; 

										repeaterIndex = $repeater.index() - $repeaterAll.index();
									} 

									if (fieldType == 'file') { 
										if($(this).hasClass('error')) {
											error++;
										} else {
											let nameFileUpload = [];
											fieldName = $(this).attr('id').replace('form-field-','');

											$.each($(this)[0].files, function(i, file){
												nameFileUpload.push(file.name);
												formData.append( fieldName + '[]', file);
											});

											var fieldItem = {}; 
											fieldItem['label'] = $(this).closest('.elementor-field-group').find('.elementor-field-label').html();
											fieldItem['name'] = fieldName;
											fieldItem['value'] = '';
											fieldItem['type'] = $(this).attr('type');
											fieldItem['upload'] = 1;
											fieldItem['file_name'] = nameFileUpload
											fieldItem['repeater_id'] = repeaterID;
											fieldItem['repeater_id_one'] = repeaterIDOne;
											fieldItem['repeater_label'] = repeaterLabel;
											fieldItem['repeater_index'] = repeaterIndex;
											fieldItem['repeater_length'] = repeaterLength;

											if ($(this).data('pafe-form-builder-remove-this-field-from-repeater') != undefined) {
					                    		fieldItem['repeater_remove_this_field'] = '1';
				                    		}

											if ($(this).data('pafe-form-builder-remove-this-field-from-repeater') != undefined) {
					                    		fieldItem['repeater_remove_this_field'] = '1';
				                    		}

											if($(this).data('attach-files') != undefined) {
												fieldItem['attach-files'] = 1;
											}

											fieldsOj.push(fieldItem);

										}

									} else {
										if (fieldName.indexOf('[]') !== -1) {
						                    var fieldValueMultiple = [];

						                    if (fieldType == 'checkbox') {
						                        $(this).closest('.elementor-element').find('[name="'+ fieldName + '"]:checked').each(function () {
						                            fieldValueMultiple.push($(this).val());
						                        });
						                    } else {
						                        fieldValueMultiple = $(this).val();
						                        if (fieldValueMultiple == null) {
						                            var fieldValueMultiple = [];
						                        }
						                    }

						                    fieldValue = '';
						                    var fieldValueByLabel = '';

						                    var fieldBooking = [];

						                    for (var j = 0; j < fieldValueMultiple.length; j++) {
						                    	if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
						                    		var fieldValueSelected = fieldValueMultiple[j];

						                    		if (fieldType == 'checkbox') {
							                    		var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
							                			if ($optionSelected.length > 0) {
							                				fieldValueByLabel += $optionSelected.data('pafe-form-builder-send-data-by-label') + ',';
							                			}
						                			} else {
						                				var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
							                			if ($optionSelected.length > 0) {
							                				fieldValueByLabel += $optionSelected.html() + ',';
							                			}
						                			}
					                    		} 

					                    		fieldValue += fieldValueMultiple[j] + ',';

					                    		if ($(this).attr('data-pafe-form-booking-item-options') != undefined) {
						                			var fieldValueSelected = fieldValueMultiple[j];
						                			
						                			var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
						                			if ($optionSelected.length > 0) {
					                					fieldBooking.push($optionSelected.attr('data-pafe-form-booking-item-options'));  
						                			}
				                				}
						                    }

						                    fieldValue = fieldValue.replace(/,(\s+)?$/, '');
										} else {
											if (fieldType == 'radio' || fieldType == 'checkbox') {
							                    if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
													var fieldValueByLabel = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').data('pafe-form-builder-send-data-by-label');
												}

												var fieldValue = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').val();
												fieldValue = fieldValue ? fieldValue : ''
							                } else {
							                	if ($(this).data('pafe-form-builder-calculated-fields') != undefined) {
							                		var fieldValue = $(this).siblings('.pafe-calculated-fields-form').text();
							                	} else {
							                		if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
							                			if ($(this).val() !== null) {
							                				var fieldValueSelected = $(this).val().trim();
							                			}
							                			var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
							                			if ($optionSelected.length > 0) {
							                				fieldValueByLabel = $optionSelected.html();
							                			}
							                		}

							                		if ($(this).val() !== null) {
							                			var fieldValue = $(this).val().trim();
						                			}
							                	}
							                }
										}
										
										if (fieldValue != undefined) {
											var fieldItem = {};
											fieldItem['label'] = $(this).closest('.elementor-field-group').find('.elementor-field-label').html();
											fieldItem['name'] = fieldName.replace('[]','').replace('form_fields[','').replace(']','');
											fieldItem['value'] = fieldValue;
											if (fieldValueMultiple != undefined) {
												fieldItem['value_multiple'] = fieldValueMultiple;
											}
											fieldItem['type'] = $(this).attr('type');

											if ($(this).attr('data-pafe-form-builder-address-autocomplete') !== undefined) {
												fieldItem['lat'] = $(this).attr('data-pafe-form-builder-google-maps-lat');
												fieldItem['lng'] = $(this).attr('data-pafe-form-builder-google-maps-lng');
												fieldItem['zoom'] = $(this).attr('data-pafe-form-builder-google-maps-zoom');
											}

											if (typeof fieldBooking !== 'undefined' && fieldBooking.length > 0) {
											    fieldItem['booking'] = fieldBooking;
											}

											if (fieldValueByLabel != '') {
												fieldItem['value_label'] = fieldValueByLabel;
											}

											if ($(this).closest('.elementor-field-type-calculated_fields').length > 0) {
												fieldItem['calculation_results'] = $(this).val().trim();
											}

						                	if ($(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0) {
						                		fieldItem['repeater_id'] = repeaterID;
						                		fieldItem['repeater_id_one'] = repeaterIDOne;
												fieldItem['repeater_index'] = repeaterIndex;
												fieldItem['repeater_label'] = repeaterLabel;
												fieldItem['repeater_length'] = repeaterLength;

												if ($(this).data('pafe-form-builder-remove-this-field-from-repeater') != undefined) {
						                    		fieldItem['repeater_remove_this_field'] = '1';
					                    		}
											     
											}
											//Remove option value for number field
											if($(this).attr('data-pafe-remove-value') != undefined && $(this).attr('data-pafe-remove-value') != 'false'){
												if($(this).val() == $(this).attr('data-pafe-remove-value')){
													fieldItem['value'] = '';
												}
											}
											fieldsOj.push(fieldItem);
										}
									}
								}
							}
						}
					});

					if (error == 0) {

						stripe.createToken(card).then(function(result) {
							if (result.error) {
								// Inform the user if there was an error
								//var errorElement = document.getElementById('card-errors');
								//errorElement.textContent = result.error.message;
							} else {
								$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 0.45});
								$submit.closest('.elementor-element').css({'opacity' : 0.45});
								$submit.closest('.elementor-element').addClass('elementor-form-waiting');

								$parent.find('.elementor-message').removeClass('visible');

								var amount = 0;

								if ($submit.data('pafe-form-builder-stripe-amount') != undefined) {
									amount = $submit.data('pafe-form-builder-stripe-amount');
								} else {
									if ($submit.data('pafe-form-builder-stripe-amount-field') != undefined) {
										var stripeAmountFieldName = $submit.data('pafe-form-builder-stripe-amount-field').replace('[field id="','').replace('"]','');
										amount = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + stripeAmountFieldName + ']"]').val();
									}
								}

								var description = '';

								if ($submit.data('pafe-form-builder-stripe-customer-info-field') != undefined) {
									var customerInfoFieldName = $submit.data('pafe-form-builder-stripe-customer-info-field').replace('[field id="','').replace('"]','');
									description = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + customerInfoFieldName + ']"]').val();
								}

								var data = {
									'action': 'pafe_ajax_form_builder',
									'post_id': $(document).find('input[name="post_id"][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').eq(0).closest('[data-elementor-id]').data('elementor-id'),
									'form_id': $(document).find('input[name="form_id"][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').val(),
									'fields' : fieldsOj,
									'stripeToken': result.token.id,
									'amount' : amount,
									'description' : description,
								};

								formData.append("action", "pafe_ajax_stripe_intents");
								formData.append("post_id", $parent.find('input[name="post_id"]').closest('[data-elementor-id]').data('elementor-id'));
								formData.append("form_id", $parent.find('input[name="form_id"]').val());
								formData.append("fields", JSON.stringify(fieldsOj));
								formData.append("referrer", window.location.href);
								formData.append("remote_ip",$(document).find('input[name="remote_ip"][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').val());
								formData.append("stripeToken", result.token.id);
								formData.append("amount", amount);
								formData.append("description", description);

								if ($(this).data('pafe-form-builder-woocommerce-product-id') != undefined) {
									formData.append("product_id", $(this).data('pafe-form-builder-woocommerce-product-id'));
								}

								if ($submit.data('pafe-form-builder-submit-post-edit') != undefined) {
									formData.append("edit", $submit.data('pafe-form-builder-submit-post-edit'));
								}

								if ($submit.data('pafe-form-builder-submit-recaptcha') != undefined) {
									var recaptchaSiteKey = $submit.data('pafe-form-builder-submit-recaptcha');
									grecaptcha.ready(function() {
							            grecaptcha.execute(recaptchaSiteKey, {action: 'create_comment'}).then(function(token) {
							            	formData.append("recaptcha",token);

							            	stripe.createPaymentMethod('card', card, {
												// billing_details: {name: cardholderName.value}
											}).then(function(result) {
												if (result.error) {
													// Show error in payment form
												} else {

													formData.append("payment_method_id", result.paymentMethod.id);

													$.ajax({
														url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
														type: 'POST',
														data: formData,
														processData: false,
														contentType: false,
														success: function (response) {
															var post_id = $(document).find('input[name="post_id"][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').eq(0).closest('[data-elementor-id]').data('elementor-id'),
																fields = JSON.stringify(fieldsOj);

													        var	json = JSON.parse(response);
													        //response.json().then(function(json) { 
															var payment_result = handleServerResponse(json, post_id, formID, fields, amount, stripe, formData, $parent, $(this));
															card.clear();
														},
														error: function () {
															$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
												        	$parent.css({'opacity' : 1});
															$parent.removeClass('elementor-form-waiting');
															$parent.find('.pafe-form-builder-alert--stripe .elementor-message-danger').addClass('visible');
															$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');
															card.clear();
														},

													});
												}
											});

							            });
							        });
						        } else {

									stripe.createPaymentMethod('card', card, {
										// billing_details: {name: cardholderName.value}
									}).then(function(result) {
										if (result.error) {
											// Show error in payment form
										} else {

											formData.append("payment_method_id", result.paymentMethod.id);

											$.ajax({
												url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
												type: 'POST',
												data: formData,
												processData: false,
												contentType: false,
												success: function (response) {
													var post_id = $(document).find('input[name="post_id"][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').eq(0).closest('[data-elementor-id]').data('elementor-id'),
														fields = JSON.stringify(fieldsOj);
											        var	json = JSON.parse(response);
											        //response.json().then(function(json) { 
													var payment_result = handleServerResponse(json, post_id, formID, fields, amount, stripe, formData, $parent, $(this));
													card.clear();
												},
												error: function () {
													$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
										        	$parent.css({'opacity' : 1});
													$parent.removeClass('elementor-form-waiting');
													$parent.find('.pafe-form-builder-alert--stripe .elementor-message-danger').addClass('visible');
													$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');
													card.clear();
												},

											});
										}
									});
								}

							}
						});

					}
				}
		    });

		});

	};

	function handleServerResponse(response, post_id, form_id, fields, amount, stripe, formData, parent, $this) {  
	  if (response.error) { 
	    // Show error from server on payment form
	    submitStripeForm('failed', parent, form_id, formData, $this, response); 
	  } else if (response.requires_action) {
	    // Use Stripe.js to handle required card action
	    if (response.subscriptions) {
	    	stripe.handleCardPayment(response.payment_intent_client_secret).then(function(result) {
			  if (result.error) {
			    // Display error.message in your UI.
			  } else {
			    // The payment has succeeded. Display a success message. 
		        submitStripeForm('succeeded', parent, form_id, formData, $this, response); 
			  }
			});
	    } else {
		    stripe.handleCardAction(
		      response.payment_intent_client_secret
		    ).then(function(result) {
		      if (result.error) {
		        // Show error in payment form
		        submitStripeForm('failed', parent, form_id, formData, $this, response); 
		      } else {
		        // The card action has been handled
		        // The PaymentIntent can be confirmed again on the server

		        formData.delete('payment_method_id');
		        formData.append('payment_intent_id', result.paymentIntent.id);

		        $.ajax({
					url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (confirmResult) {
			        	handleServerResponse(JSON.parse(confirmResult), post_id, form_id, fields, amount, stripe, formData); 
			        }
		        }); 
		      }
		    });
	    }

	  } else {
	    // Show success message
	    submitStripeForm('succeeded', parent, form_id, formData, $this, response); 
	  }
	} 

	function submitStripeForm(paymentResult, parent, formID, formData, $this, responseIntent) {

    	var $parent = $(document).find('[data-pafe-form-builder-submit-form-id="' + formID + '"]').closest('.elementor-element');

    	if (paymentResult == 'failed') {
    		$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
        	$parent.css({'opacity' : 1});
			$parent.removeClass('elementor-form-waiting');
			$parent.find('.pafe-form-builder-alert--stripe .elementor-message-danger').addClass('visible');
			$(document).find('[data-pafe-form-builder-submit-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
			$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');
		} else { 
    	
			formData.delete('stripeToken');
			formData.delete('action');
			formData.append('action', 'pafe_ajax_form_builder');
			formData.append('payment_intent_id', responseIntent.payment_intent_id );

			$.ajax({
				url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
		        	$parent.css({'opacity' : 1});
					$parent.removeClass('elementor-form-waiting');
					var response = response.trim();

					if (response.indexOf(',') !== -1) {
						var responseArray = JSON.parse(response);
						if(responseArray.custom_message){
							$parent.find('[data-pafe-form-builder-message]').html(responseArray.custom_message);
						}
						$parent.find('.elementor-message').each(function(){
							if (responseArray.post_url != '') {
				        		var html = $(this).html().replace('[post_url]','<a href="' + responseArray.post_url + '">' + responseArray.post_url + '</a>');
				        		$(this).html(html);
				        	}
						});

						if (paymentResult == 'succeeded' || paymentResult == 'active') {
			        		$parent.find('.pafe-form-builder-alert--stripe .elementor-message-success').addClass('visible');
			        		$parent.find('[data-pafe-form-builder-trigger-success]').trigger('click');
			        	} else {
			        		$parent.find('.pafe-form-builder-alert--stripe .elementor-message-danger').addClass('visible');
			        		$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
							$(document).find('[data-pafe-form-builder-submit-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
							$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');
			        	}

			        	if (responseArray.status != '') {
			        		$parent.find('.pafe-form-builder-alert--mail .elementor-message-success').addClass('visible');
			        	} else {
			        		$parent.find('.pafe-form-builder-alert--mail .elementor-message-danger').addClass('visible');
			        		$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
							$(document).find('[data-pafe-form-builder-submit-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});

							if (responseArray.register_message != '') {
				        		$parent.find('.pafe-form-builder-alert--mail .elementor-message-danger').html(responseArray.register_message.replace(/###/g, ','));
				        	}
			        	}
	 
			        	if ($parent.find('input[name="redirect"]').length != 0) {
		        			var href = $parent.find('input[name="redirect"]').val().trim();
		        			var open_tab = $parent.find('input[name="redirect"]').attr('data-pafe-form-builder-open-new-tab');
		        			if (response.indexOf(',') !== -1) {
								if (responseArray.failed_status != '1') {
									if (responseArray.post_url != '' && href=='[post_url]') {
										window.location.href = responseArray.post_url;
									} else {
										if (responseArray.redirect != '') {
											if (open_tab =='yes') {
										        window.open(responseArray.redirect, "_blank");
										    } else {
											    window.location.href = responseArray.redirect;
											} 
										}
									}
								}
							}
		        		}

		        		// Popup
						
						if ($(document).find('[data-pafe-form-builder-popup][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
							$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
						}
						if(responseArray.popup){
							if ($(document).find('[data-pafe-form-builder-popup-open][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
								$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
							}
						}

						if ($(document).find('[data-pafe-form-builder-popup-close][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
							$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
						}
					}
		        }
	  		});
  		}
	}

	var WidgetPafeNumberSpinerHandler = function ($scope, $) {
		var $elements = $scope.find('[data-pafe-form-builder-spiner] input[type="number"]');

		if (!$elements.length) {
			return;
		}

		$.each($elements, function (i, $element) {
			$($element).niceNumber({
				autoSize: false,
			});
		});

    };

	$(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/pafe-form-builder-field.default', WidgetPafeFormBuilderHandlerDate);
        elementorFrontend.hooks.addAction('frontend/element_ready/pafe-form-builder-field.default', WidgetPafeFormBuilderHandlerTime);
        elementorFrontend.hooks.addAction('frontend/element_ready/pafe-form-builder-field.default', WidgetPafeFormBuilderHandlerImageSelect);
        elementorFrontend.hooks.addAction('frontend/element_ready/pafe-form-builder-field.default', WidgetPafeFormBuilderHandlerStripe);
        elementorFrontend.hooks.addAction('frontend/element_ready/pafe-form-builder-field.default', WidgetPafeNumberSpinerHandler);
    });

    function getIndexColumn(column) {
		var columnArray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

		var columnFirstWord = column.slice(0,1).toUpperCase(),
			columnSecondWord = column.slice(1,2).toUpperCase(),
			index = 0;
		  
		if(columnSecondWord == '') {
		  index = columnArray.indexOf(columnFirstWord);
		} else {
		  index = (columnArray.indexOf(columnFirstWord) + 1)*26 + columnArray.indexOf(columnSecondWord);
		}

		return index;
	}
})(jQuery);

jQuery(document).ready(function( $ ) { 

	function getIndexColumn(column) {
		var columnArray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

		var columnFirstWord = column.slice(0,1).toUpperCase(),
			columnSecondWord = column.slice(1,2).toUpperCase(),
			index = 0;
		  
		if(columnSecondWord == '') {
		  index = columnArray.indexOf(columnFirstWord);
		} else {
		  index = (columnArray.indexOf(columnFirstWord) + 1)*26 + columnArray.indexOf(columnSecondWord);
		}

		return index;
	}

	$(document).on('change','[name="upload_field"]',function(){
		var $form = $(this).closest('form');

		var $input = $(this),
			extension = $input.data('accept');

		if (extension == undefined) {
			extension = 'jpg,jpeg,png,gif,pdf,doc,docx,ppt,pptx,odt,avi,ogg,m4a,mov,mp3,mp4,mpg,wav,wmv';
		}

		if (extension != undefined) {
			if (extension.trim() == '') {
				extension = 'jpg,jpeg,png,gif,pdf,doc,docx,ppt,pptx,odt,avi,ogg,m4a,mov,mp3,mp4,mpg,wav,wmv';
			}
		}

		$form.validate({
			rules: {
				'upload_field': {
					extension: extension,
					maxsize: parseInt( $input.data('maxsize') ) * 1048576,
				}
			},
							  
		    messages:{
		        'upload_field': {
		        	extension: $input.data('types-message'),
		        	maxsize: $input.data('maxsize-message'),
		        }

		    }
	    });

		$form.submit(function (ev) {
    		ev.preventDefault();
	    });
		$form.trigger('submit');
	});

	window.pafeValidateFields = function ($fields) {
    	var error = 0;

    	$fields.each(function(){
			if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {
				var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
				var checked = 0;
				if ($checkboxRequired.length > 0) {
					checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
				} 

				if ($(this).attr('oninvalid') != undefined) {
					requiredText = $(this).attr('oninvalid').replace("this.setCustomValidity('","").replace("')","");
				}

				var isValid = $(this)[0].checkValidity();
				var next_ele = $($(this)[0]).next()[0];
				if ($(next_ele).hasClass('flatpickr-mobile')) {
					isValid = next_ele.checkValidity();
				}
				
				if ( !isValid && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).closest('[data-pafe-form-builder-conditional-logic]').css('display') != 'none' && $(this).data('pafe-form-builder-honeypot') == undefined &&  $(this).closest('[data-pafe-signature]').length == 0 || checked == 0 && $checkboxRequired.length > 0 && $(this).closest('.elementor-element').css('display') != 'none') {
					if ($(this).css('display') == 'none' || $(this).closest('div').css('display') == 'none' || $(this).data('pafe-form-builder-image-select') != undefined || $checkboxRequired.length > 0) {
						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
					} else {
						if ($(this).data('pafe-form-builder-image-select') == undefined) {
							$(this)[0].reportValidity();
						} 
					}
					error++;
				} else {
					if ($(this).val()=='' && $(this).attr('aria-required') == "true" && $(this).attr('data-pafe-form-builder-select-autocomplete') !== undefined) {
						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
						error++;
					} else {
						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

						if ($(this).closest('[data-pafe-signature]').length > 0) {
							var $pafeSingature = $(this).closest('[data-pafe-signature]'),
								$exportButton = $pafeSingature.find('[data-pafe-signature-export]');

							$exportButton.trigger('click');

							if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') != undefined) {
								$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
								error++;
							} 
						} 
					}
				}
			}
		});

		return error;
    }
	
	$(document).on('click','[data-pafe-form-builder-submit-form-id]',function(){
		if ( $(this).attr('data-pafe-form-builder-stripe-submit') == undefined ) {
	    	var formID = $(this).data('pafe-form-builder-submit-form-id'),
	    		$fields = $(document).find('[data-pafe-form-builder-form-id='+ formID +']'),
	    		requiredText = $(this).data('pafe-form-builder-required-text'),
	    		fieldsOj = [],
	    		error = 0
	    		formData = new FormData();
            var isAlertRequired = false;
    		var $submit = $(this);
			var $parent = $submit.closest('.elementor-element');
			$fields.each(function(){
				if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {
					var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
					var checked = 0;
					if ($checkboxRequired.length > 0) {
						checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
					} 

					if ($(this).attr('oninvalid') != undefined) {
						requiredText = $(this).attr('oninvalid').replace("this.setCustomValidity('","").replace("')","");
					}
					//Check repassword
					if($(this).attr('data-pafe-is-repassword') != undefined && $(this).attr('data-pafe-is-repassword') != ''){
						var password_compare = $('[name="form_fields['+$(this).attr('data-pafe-is-repassword')+']"]').val();
						var password_msg = $(this).attr('data-pafe-repassword-msg');
						if(String(password_compare) !== String($(this).val())){
							this.setCustomValidity(password_msg);
							error++;
							$(this).on('keyup', function(){
								this.setCustomValidity("");
							})
						}else{
							this.setCustomValidity("");
						}
					}
					// Check confirm field
					if(typeof $(this).attr('data-pafe-confirm-field') !== 'undefined' && $(this).attr('data-pafe-confirm-field') !== false){
						let confirmValue = $('[name="form_fields['+$(this).attr('data-pafe-confirm-field')+']"]').val();
						let confirmMsg = $(this).attr('data-pafe-confirm-msg');
						if(String(confirmValue) !== String($(this).val())){
							this.setCustomValidity(confirmMsg);
							error++;
							$(this).on('keyup', function(){
								this.setCustomValidity("");
							})
						}else{
							this.setCustomValidity("");
						}
					}
					//IBAN Field
					if($(this).attr('data-pafe-iban-field') != undefined){
						if(!IBAN.isValid($(this).val())){
							let iban_msg = $(this).attr('data-pafe-iban-msg');
							this.setCustomValidity(iban_msg);
							error++;
							$(this).on('keyup', function(){
								this.setCustomValidity("");
							})
						}
					}

					var isValid = $(this)[0].checkValidity();
					var next_ele = $($(this)[0]).next()[0];
					if ($(next_ele).hasClass('flatpickr-mobile')) {
						isValid = next_ele.checkValidity();
					}

					if ( !isValid && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).closest('[data-pafe-form-builder-conditional-logic]').css('display') != 'none' && $(this).data('pafe-form-builder-honeypot') == undefined &&  $(this).closest('[data-pafe-signature]').length == 0 || checked == 0 && $checkboxRequired.length > 0 && $(this).closest('.elementor-element').css('display') != 'none') {
						if ($(this).css('display') == 'none' || $(this).closest('div').css('display') == 'none' || $(this).data('pafe-form-builder-image-select') != undefined || $checkboxRequired.length > 0) {
							$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
                            var scrollRequired = $(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').next();
                                if (scrollRequired.length !== 0 && !isAlertRequired ) {
                                    $('html, body').animate({scrollTop: scrollRequired.offset().top}, 500);
                                    isAlertRequired = true;
                                }
						} else {
							if (!isAlertRequired && $(this).data('pafe-form-builder-image-select') == undefined) {
								$(this)[0].reportValidity();
								isAlertRequired = true;
							} 
						}
						error++;
					} else {
						if ($(this).val()=='' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0  && $(this).attr('aria-required') == "true" && $(this).attr('data-pafe-form-builder-select-autocomplete') !== undefined) {
							$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
							error++;
						} else {
							if ( $(this).data('pafe-form-builder-image-select') != undefined ) {
								if ( $(this).closest('.pafe-image-select-field').find('.image_picker_selector').find('.selected').length < $(this).data('pafe-form-builder-image-select-min-select') ) {
									$(this).closest('.elementor-field-group').find('[data-pafe-image_select_min_select_check]').html($(this).data('pafe-form-builder-image-select-min-select-message'));
									error++;
								} else {
									$(this).closest('.elementor-field-group').find('[data-pafe-image_select_min_select_check]').remove();
								}
							}

							var $label = $(this).closest('.pafe-field-container').find('label'),
								$container = $(this).closest('.pafe-field-container'),
								minFiles = 1;
							if ($label.attr('data-pafe-form-builder-image-upload-min-files') != undefined) {
								minFiles = parseInt($label.attr('data-pafe-form-builder-image-upload-min-files'));
								var filesCurrent = $container.find('.pafe-form-builder-image-upload-uploaded').length;
								if ( filesCurrent < minFiles ) {
									$container.find('[data-pafe-form-builder-image-upload-check]').html($label.attr('data-pafe-form-builder-image-upload-min-files-message'));
									error++;
								} else {
									$container.find('[data-pafe-form-builder-image-upload-check]').remove();
								}
							}

							$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

                            if ($(this).data('pafe-flatpickr-custom-options')!= undefined) {
                                if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') != undefined) {
                                    $(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
                                    error++;
                                }
                            }

							if ($(this).closest('[data-pafe-signature]').length > 0) {
								var $pafeSingature = $(this).closest('[data-pafe-signature]'),
									$exportButton = $pafeSingature.find('[data-pafe-signature-export]');

								$exportButton.trigger('click');

								if ($(this).val() == '' && $(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0 && $(this).attr('required') != undefined) {
									$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html(requiredText);
									error++;
								} 
							}

							var fieldType = $(this).attr('type'),
								fieldName = $(this).attr('name');

							var $repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]'),
								repeaterID = '',
								repeaterIDOne = '',
								repeaterLabel = '',
								repeaterIndex = -1,
								repeaterLength = 0;

							if ($repeater.length > 0) {
								$repeaterParents = $(this).parents('[data-pafe-form-builder-repeater-form-id]');
								repeaterIDOne = $repeater.data('pafe-form-builder-repeater-id');
								$repeaterParents.each(function(){
									var repeaterParentID = $(this).data('pafe-form-builder-repeater-id'),
										$repeaterParentAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"][data-pafe-form-builder-repeater-id="' + repeaterParentID + '"]');

									repeaterParentIndex = $(this).index() - $repeaterParentAll.index();
									repeaterID += repeaterParentID + '|index' + repeaterParentIndex + '|' + fieldName.replace('[]','').replace('form_fields[','').replace(']','') + ',';
								});

								repeaterLabel = $repeater.data('pafe-form-builder-repeater-label');

								var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]');
								repeaterLength = $repeater.siblings('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]').length + 1; 

								repeaterIndex = $repeater.index() - $repeaterAll.index();
							}

							if (fieldType == 'file') { 
								if($(this).hasClass('error')) {
									error++;
								} else {
									let nameFileUpload = [];
									fieldName = $(this).attr('id').replace('form-field-','');

									$.each($(this)[0].files, function(i, file){
										nameFileUpload.push(file.name);
										formData.append( fieldName + '[]', file);
									});

									var fieldItem = {};
									fieldItem['label'] = $(this).closest('.elementor-field-group').find('.elementor-field-label').html();
									fieldItem['name'] = fieldName;
									fieldItem['value'] = '';
									fieldItem['type'] = $(this).attr('type');
									fieldItem['upload'] = 1;
									fieldItem['file_name'] = nameFileUpload
									fieldItem['repeater_id'] = repeaterID;
									fieldItem['repeater_id_one'] = repeaterIDOne;
									fieldItem['repeater_label'] = repeaterLabel;
									fieldItem['repeater_index'] = repeaterIndex;
									fieldItem['repeater_length'] = repeaterLength;

									if ($(this).data('pafe-form-builder-remove-this-field-from-repeater') != undefined) {
			                    		fieldItem['repeater_remove_this_field'] = '1';
		                    		}

									if($(this).data('attach-files') != undefined) {
										fieldItem['attach-files'] = 1;
									}
									
									fieldsOj.push(fieldItem);

								}

								// [ Fix alert
							} else {
								if (fieldName.indexOf('[]') !== -1) {
				                    var fieldValueMultiple = [];

				                    if (fieldType == 'checkbox') {
				                        $(this).closest('.elementor-element').find('[name="'+ fieldName + '"]:checked').each(function () {
				                            fieldValueMultiple.push($(this).val());
				                        }); 
				                    } else {
				                        fieldValueMultiple = $(this).val();
				                        if (fieldValueMultiple == null) {
				                            var fieldValueMultiple = [];
				                        }
				                    }

				                    fieldValue = '';
				                    var fieldValueByLabel = '';

				                    var fieldBooking = [];

				                    for (var j = 0; j < fieldValueMultiple.length; j++) {
				                    	if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
				                    		var fieldValueSelected = fieldValueMultiple[j];

				                    		if (fieldType == 'checkbox') {
					                    		var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
					                			if ($optionSelected.length > 0) {
					                				fieldValueByLabel += $optionSelected.data('pafe-form-builder-send-data-by-label') + ',';
					                			}
				                			} else {
				                				var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
					                			if ($optionSelected.length > 0) {
					                				fieldValueByLabel += $optionSelected.html() + ',';
					                			}
				                			}
			                    		}

			                    		fieldValue += fieldValueMultiple[j] + ',';

			                    		if ($(this).attr('data-pafe-form-booking-item-options') != undefined) {
				                			var fieldValueSelected = fieldValueMultiple[j];
				                			
				                			var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
				                			if ($optionSelected.length > 0) {
				                				//console.log($optionSelected.attr('data-pafe-form-booking-item-options'));
			                					fieldBooking.push($optionSelected.attr('data-pafe-form-booking-item-options'));  
				                			}
		                				}
				                    }

				                    fieldValue = fieldValue.replace(/,(\s+)?$/, '');
								} else {
									if (fieldType == 'radio' || fieldType == 'checkbox') {
										if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
											var fieldValueByLabel = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').data('pafe-form-builder-send-data-by-label');
										}

										var fieldValue = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').val();
										fieldValue = fieldValue ? fieldValue : '';
					                } else {
					                	if ($(this).data('pafe-form-builder-calculated-fields') != undefined) {
					                		var fieldValue = $(this).siblings('.pafe-calculated-fields-form').text();
					                	} else {
					                		if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
					                			if ($(this).val() !== null) {
					                				var fieldValueSelected = $(this).val().trim();
					                			}
					                			
					                			var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
					                			if ($optionSelected.length > 0) {
					                				fieldValueByLabel = $optionSelected.html();
					                			}
					                		}

					                		if ($(this).val() !== null) {
				                				var fieldValue = $(this).val().trim();
				                			}
					                	}
										if ( fieldType == 'tel' && $(this).attr('data-pafe-tel-field') !== undefined) {
											var fieldValue = $(this).intlTelInput("getNumber");
										}
					                }
								}
								
								if (fieldValue != undefined) {
									var fieldItem = {};
									fieldItem['label'] = $(this).closest('.elementor-field-group').find('.elementor-field-label').html();
									fieldItem['name'] = fieldName.replace('[]','').replace('form_fields[','').replace(']','');
									var pafeRangeSlider = $(this).attr('data-pafe-form-builder-range-slider-options');
									var pafeImageUpload = $(this).attr('data-pafe-field-type');
									fieldItem['image_upload'] = pafeImageUpload ? true : false;
									if(pafeRangeSlider != undefined){
										var pafeRangeSliderSet = JSON.parse(pafeRangeSlider);
										if(pafeRangeSliderSet.prefix || pafeRangeSliderSet.postfix){
											var pafeRangeSliderValue = pafeRangeSliderSet.input_values_separator ? fieldValue.split(pafeRangeSliderSet.input_values_separator) : fieldValue.split(';');
											$.each(pafeRangeSliderValue, function(index, value){
												pafeRangeSliderValue[index] = pafeRangeSliderSet.prefix ? pafeRangeSliderSet.prefix + value : value + pafeRangeSliderSet.postfix;
											});
											fieldItem['value'] = pafeRangeSliderSet.input_values_separator ? pafeRangeSliderValue.join(pafeRangeSliderSet.input_values_separator) : pafeRangeSliderValue.join(';');
										}else{
											fieldItem['value'] = fieldValue;
										}
									}else{
										fieldItem['value'] = fieldValue;
									}
									if (fieldValueMultiple != undefined) {
										fieldItem['value_multiple'] = fieldValueMultiple;
									}
									fieldItem['type'] = $(this).attr('type');

									if ($(this).attr('data-pafe-form-builder-address-autocomplete') !== undefined) {
										fieldItem['lat'] = $(this).attr('data-pafe-form-builder-google-maps-lat');
										fieldItem['lng'] = $(this).attr('data-pafe-form-builder-google-maps-lng');
										fieldItem['zoom'] = $(this).attr('data-pafe-form-builder-google-maps-zoom');
									}

									if (typeof fieldBooking !== 'undefined' && fieldBooking.length > 0) {
									    fieldItem['booking'] = fieldBooking;
									}

									if (fieldValueByLabel != '') { 
										fieldItem['value_label'] = fieldValueByLabel;
									}
									
									if ($(this).closest('.elementor-field-type-calculated_fields').length > 0) {
										fieldItem['calculation_results'] = $(this).val().trim();
									}
									
									if ($(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0) {
										fieldItem['repeater_id'] = repeaterID;
										fieldItem['repeater_id_one'] = repeaterIDOne;
										fieldItem['repeater_label'] = repeaterLabel; 
										fieldItem['repeater_index'] = repeaterIndex; 
										fieldItem['repeater_length'] = repeaterLength;

										if ($(this).data('pafe-form-builder-remove-this-field-from-repeater') != undefined) {
				                    		fieldItem['repeater_remove_this_field'] = '1';
			                    		}
									     
									}
									//Remove option value for number field
									if($(this).attr('data-pafe-remove-value') != undefined && $(this).attr('data-pafe-remove-value') != 'false'){
										if($(this).val() == $(this).attr('data-pafe-remove-value')){
											fieldItem['value'] = '';
										}
									}
									fieldsOj.push(fieldItem);
								}
							}
						}
					}
				}
			});

			if (error == 0) {

				$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 0.45});
				$(this).closest('.elementor-element').css({'opacity' : 0.45});
				$(this).closest('.elementor-element').addClass('elementor-form-waiting');

				formData.append("action", "pafe_ajax_form_builder");
				formData.append("post_id", $parent.find('input[name="post_id"]').closest('[data-elementor-id]').data('elementor-id'));
				formData.append("form_id", $parent.find('input[name="form_id"]').val());
				formData.append("fields", JSON.stringify(fieldsOj)); 
				formData.append("referrer", window.location.href);
				formData.append("remote_ip",$(document).find('input[name="remote_ip"][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').val());

				if ($(this).data('pafe-form-builder-submit-post-edit') != undefined) {
					formData.append("edit", $(this).data('pafe-form-builder-submit-post-edit'));
				}

				if ($(this).data('pafe-form-builder-woocommerce-product-id') != undefined) {
					formData.append("product_id", $(this).data('pafe-form-builder-woocommerce-product-id'));
				}

				if ($(this).attr('data-pafe-form-builder-paypal-submit-transaction-id') != undefined) {
					formData.append("paypal_transaction_id", $(this).attr('data-pafe-form-builder-paypal-submit-transaction-id'));
				}

				if ($(this).data('pafe-form-builder-submit-recaptcha') != undefined) {
					let r_molliePayment = $(this).data('pafe-form-builder-mollie-payment');
					var recaptchaSiteKey = $(this).data('pafe-form-builder-submit-recaptcha');

					grecaptcha.ready(function() {
			            grecaptcha.execute(recaptchaSiteKey, {action: 'create_comment'}).then(function(token) {
							if(typeof r_molliePayment !== 'undefined' && r_molliePayment !== false){
								let mollie_redirect_url = new URL(window.location.href);
								let mollie_redirect_url_params = new URLSearchParams(mollie_redirect_url.search);
								if(window.location.href.indexOf('#') != -1){
									let mollie_redirect_url_start = window.location.href.slice(0,  window.location.href.indexOf("#"));
									let mollie_redirect_url_end = window.location.href.slice( window.location.href.indexOf("#"));
									let mollieUrl = new URL(mollie_redirect_url_start);
									let mollieUrlParams = new URLSearchParams(mollieUrl.search);
									if(mollieUrlParams.toString() == ''){
										mollie_redirect_url = mollie_redirect_url_start + '?pafe_action=mollie_payment' + mollie_redirect_url_end;
									}else{
										mollie_redirect_url = mollie_redirect_url_start + '&pafe_action=mollie_payment' + mollie_redirect_url_end;
									}
								}else{
									if(mollie_redirect_url_params.toString() == ''){
										mollie_redirect_url = window.location.href + '?pafe_action=mollie_payment'
									}else{
										mollie_redirect_url = window.location.href + '&pafe_action=mollie_payment'
									}
								}
								formData.append("mollie_payment", true);
								formData.append("mollie_redirect_url", mollie_redirect_url);
								$.ajax({
									url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
									type: 'POST',
									dataType: "json",
									data: formData,
									processData: false,
									contentType: false,
									success: function (response) {
										if(response.status == 'open'){
											let formDataObj = {
												mollie_payment_id: response.id,
												formName: formID,
											};
											formData.forEach(function(value, key){
												formDataObj[key] = value;
											});
											delete formDataObj.mollie_payment
											localStorage.setItem('pafe_data_form_mollie_payment', JSON.stringify(formDataObj));
											window.location.href = response._links.checkout.href;
										}else{
											console.log(response.status);
										}
									},
									error: function(response){
										console.log('Mollie payment not success!');
									}
								});
								return;
							}
			                formData.append("recaptcha",token);

							$parent.find('.elementor-message').removeClass('visible');

							$.ajax({
								url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
								type: 'POST',
								data: formData,
								processData: false,
								contentType: false,
								success: function (response) {
									var responseArray = JSON.parse(response);
									if(responseArray.custom_message){
										$parent.find('[data-pafe-form-builder-message]').html(responseArray.custom_message);
									}
									$parent.css({'opacity' : 1});
									$parent.removeClass('elementor-form-waiting');
									$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
									if (response.trim() != '') {
						        		$parent.find('.elementor-message-success').addClass('visible');
						        		$parent.find('[data-pafe-form-builder-trigger-success]').trigger('click');
						        	} else {
						        		$parent.find('.elementor-message-danger').addClass('visible');
						        		$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');
					        		}

					        		if (response.indexOf(',') !== -1) {

										$parent.find('.elementor-message').each(function(){
											if (responseArray.post_url != '') {
								        		var html = $(this).html().replace('[post_url]','<a href="' + responseArray.post_url + '">' + responseArray.post_url + '</a>');
								        		$(this).html(html);
								        	}
										});
									}

					        		//console.log(response);
							  		// $( 'body' ).trigger( 'update_checkout' );
									// $( 'body' ).trigger( 'wc_update_cart' );

					        		if ($parent.find('input[name="redirect"]').length != 0) {
					        			var href = $parent.find('input[name="redirect"]').val().trim();
					        			var open_tab = $parent.find('input[name="redirect"]').attr('data-pafe-form-builder-open-new-tab');
					        			if (response.indexOf(',') !== -1) {
											if (responseArray.failed_status != '1') {
												if (responseArray.post_url != '' && href=='[post_url]') {
													window.location.href = responseArray.post_url;
												} else {
													if (responseArray.redirect != '') {
														if (open_tab =='yes') {
													        window.open(responseArray.redirect, "_blank");
													    } else {
														    window.location.href = responseArray.redirect;
														}
													}
												}
											}
										}
					        		}

					        		// Popup
									
									if ($submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
										$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
									}
									if(responseArray.popup){
										if ($(document).find('[data-pafe-form-builder-popup-open][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
											$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
										}
									}
									if ($(document).find('[data-pafe-form-builder-popup-close][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
										$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
									}
								}
							});
			            });
			        }); 
		        } else {
					if($(this).data('pafe-form-builder-mollie-payment') != undefined){
						let mollie_redirect_url = new URL(window.location.href);
						let mollie_redirect_url_params = new URLSearchParams(mollie_redirect_url.search);
						if(window.location.href.indexOf('#') != -1){
							let mollie_redirect_url_start = window.location.href.slice(0,  window.location.href.indexOf("#"));
							let mollie_redirect_url_end = window.location.href.slice( window.location.href.indexOf("#"));
							let mollieUrl = new URL(mollie_redirect_url_start);
							let mollieUrlParams = new URLSearchParams(mollieUrl.search);
							if(mollieUrlParams.toString() == ''){
								mollie_redirect_url = mollie_redirect_url_start + '?pafe_action=mollie_payment' + mollie_redirect_url_end;
							}else{
								mollie_redirect_url = mollie_redirect_url_start + '&pafe_action=mollie_payment' + mollie_redirect_url_end;
							}
						}else{
							if(mollie_redirect_url_params.toString() == ''){
								mollie_redirect_url = window.location.href + '?pafe_action=mollie_payment'
							}else{
								mollie_redirect_url = window.location.href + '&pafe_action=mollie_payment'
							}
						}
						formData.append("mollie_payment", true);
						formData.append("mollie_redirect_url", mollie_redirect_url);
						$.ajax({
							url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
							type: 'POST',
							dataType: "json",
							data: formData,
							processData: false,
							contentType: false,
							success: function (response) {
								if(response.status == 'open'){
									let formDataObj = {
										mollie_payment_id: response.id,
										formName: formID,
									};
									formData.forEach(function(value, key){
										formDataObj[key] = value;
									});
									delete formDataObj.mollie_payment
									localStorage.setItem('pafe_data_form_mollie_payment', JSON.stringify(formDataObj));
									window.location.href = response._links.checkout.href;
								}else{
									console.log(response.status);
								}
							},
							error: function(response){
								console.log('Mollie payment not success!');
							}
						});
						return;
					}
					$parent.find('.elementor-message').removeClass('visible');
					$.ajax({
						url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
						type: 'POST',
						data: formData,
						processData: false,
						contentType: false,
						success: function (response) {
							$parent.css({'opacity' : 1});
							$parent.removeClass('elementor-form-waiting');
							$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});

							if (response) {
								let responseArray = JSON.parse(response);
								if (responseArray.limit_entries_status) {
									$parent.find('.pafe-form-builder-alert--limit-entries .elementor-message').addClass('visible');
									return;
								}
							}

			        		if (response.indexOf(',') !== -1) {
								var responseArray = JSON.parse(response);
								if(responseArray.custom_message){
									$parent.find('[data-pafe-form-builder-message]').html(responseArray.custom_message);
								}
								$parent.find('.elementor-message').each(function(){
									if (responseArray.post_url != '') {
						        		var html = $(this).html().replace('[post_url]','<a href="' + responseArray.post_url + '">' + responseArray.post_url + '</a>');
						        		$(this).html(html);
						        	}
								});

								if (responseArray.payment_status == 'succeeded' || responseArray.payment_status == 'active') {
					        		$parent.find('.pafe-form-builder-alert--stripe .elementor-message-success').addClass('visible');
					        	}

					        	if (responseArray.payment_status == 'pending') {
					        		$parent.find('.pafe-form-builder-alert--stripe .elementor-help-inline').addClass('visible');
					        	}

					        	if (responseArray.payment_status == 'failed' || responseArray.payment_status == 'incomplete') {
					        		$parent.find('.pafe-form-builder-alert--stripe .elementor-message-danger').addClass('visible');
					        		$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
									$(this).closest('.elementor-element').css({'opacity' : 1});
					        	}

					        	if (responseArray.status != '') {
					        		$parent.find('.pafe-form-builder-alert--mail .elementor-message-success').addClass('visible');
					        		$parent.find('[data-pafe-form-builder-trigger-success]').trigger('click');
					        	} else {
					        		$parent.find('.pafe-form-builder-alert--mail .elementor-message-danger').addClass('visible');
					        		$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
									$(this).closest('.elementor-element').css({'opacity' : 1});
									$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');

									if (responseArray.register_message != '') {
						        		$parent.find('.pafe-form-builder-alert--mail .elementor-message-danger').html(responseArray.register_message.replace(/###/g, ','));
						        	}
					        	}
							}

			        		//console.log(response);
					  		// $( 'body' ).trigger( 'update_checkout' );
							// $( 'body' ).trigger( 'wc_update_cart' );


							
			        		if ($parent.find('input[name="redirect"]').length != 0) {
			        			var href = $parent.find('input[name="redirect"]').val().trim();
			        			var open_tab = $parent.find('input[name="redirect"]').attr('data-pafe-form-builder-open-new-tab');
			        			if (response.indexOf(',') !== -1) {
									if (responseArray.failed_status != '1') {
										if (responseArray.post_url != '' && href=='[post_url]') {
											window.location.href = responseArray.post_url;
										} else {
											if (responseArray.redirect != '') {
												if (open_tab =='yes') {
												    window.open(responseArray.redirect, "_blank");
												} else {
													window.location.href = responseArray.redirect;
													} 	
				
											}
										}
									}
								}
			        		}

			        		// Popup
							
							if ($(document).find('[data-pafe-form-builder-popup][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
								$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
							}
							if(responseArray.popup){
								if ($(document).find('[data-pafe-form-builder-popup-open][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
									$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
								}
							}

							if ($(document).find('[data-pafe-form-builder-popup-close][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
								$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
							}
						}
					});
				} // recaptcha

			}
		}
    });
	//Submit after mollie payment redirect
	let pafeCurrentUrlParams = new URLSearchParams(window.location.search);

	if(pafeCurrentUrlParams.get('pafe_action') === 'mollie_payment'){
		pafeCurrentUrlParams.delete('pafe_action')
		let pafeCurrentUrl = window.location.href.replace(window.location.search, '?'+pafeCurrentUrlParams.toString());
		pafeCurrentUrl = new URL(pafeCurrentUrl);
		let currentParams = new URLSearchParams(pafeCurrentUrl.search);
		currentParams.toString() ? window.history.pushState({}, '',pafeCurrentUrl.href) : window.history.pushState({}, '',pafeCurrentUrl.href.replace('?', ''));
		let mollieFormData = localStorage.getItem('pafe_data_form_mollie_payment');
		mollieFormData = JSON.parse(mollieFormData);
		let formID = mollieFormData.formName;
		let mollie_payment_status, mollieItems;
		let $parent = $('[data-pafe-form-builder-mollie-payment="'+formID+'"]').closest('.elementor-element');
		if(mollieFormData){
			let formSubmitData = JSON.parse(mollieFormData.fields);
			$.each(formSubmitData, function(index, item){
				if(item.value){
					if (item.type == 'radio') {
						$('[data-pafe-form-builder-form-id="'+formID+'"][name="form_fields['+item.name+']"][value="'+item.value+'"]').prop('checked', true);
					} else if (item.type == 'checkbox') {
						mollieItems = item.value.split(',');
						$.each(mollieItems, function(key, value){
							$('[data-pafe-form-builder-form-id="'+formID+'"][name="form_fields['+item.name+'][]"][value="'+value+'"]').prop('checked', true);
						});
					} else {
						$('[data-pafe-form-builder-form-id="'+formID+'"][name="form_fields['+item.name+']"]').val(item.value);
					}
				}
			});

			$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 0.45});
			$('[data-pafe-form-builder-mollie-payment="'+formID+'"]').closest('.elementor-element').css({'opacity' : 0.45});
			$('[data-pafe-form-builder-mollie-payment="'+formID+'"]').closest('.elementor-element').addClass('elementor-form-waiting');
			$.ajax({
				type: "post",
				dataType: "json",
				url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
				data: {
					action: "pafe_mollie_get_payment",
					payment_id: mollieFormData.mollie_payment_id
				},
				success: function(response){
					if(response.status){
						if(response.status == 'paid'){
							mollie_payment_status = "succeeded";
						}else if(response.status == 'pending'){
							mollie_payment_status = "pending";
						}else{
							mollie_payment_status = "failed";
						}
					}else{
						console.log('Mollie payment error!');
					}
				},
				error: function(response){
					console.log('Mollie payment error!');
				}
			});
			$.ajax({
				url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
				type: 'POST',
				data: mollieFormData,
				success: function (response) {
					$parent.css({'opacity' : 1});
					$parent.removeClass('elementor-form-waiting');
					$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});

					if (response.indexOf(',') !== -1) {
						
						var responseArray = JSON.parse(response);
						if(responseArray.custom_message){
							$parent.find('[data-pafe-form-builder-message]').html(responseArray.custom_message);
						}
						responseArray.payment_status = mollie_payment_status;
						
						$parent.find('.elementor-message').each(function(){
							if (responseArray.post_url != '') {
								var html = $(this).html().replace('[post_url]','<a href="' + responseArray.post_url + '">' + responseArray.post_url + '</a>');
								$(this).html(html);
							}
						});

						if (responseArray.payment_status == 'succeeded' || responseArray.payment_status == 'active') {
							$parent.find('.pafe-form-builder-alert--mollie .elementor-message-success').addClass('visible');
						}

						if (responseArray.payment_status == 'pending') {
							$parent.find('.pafe-form-builder-alert--mollie .elementor-help-inline').addClass('visible');
						}

						if (responseArray.payment_status == 'failed' || responseArray.payment_status == 'incomplete') {
							$parent.find('.pafe-form-builder-alert--mollie .elementor-message-danger').addClass('visible');
							$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
							$(this).closest('.elementor-element').css({'opacity' : 1});
						}

						if (responseArray.status != '') {
							$parent.find('.pafe-form-builder-alert--mail .elementor-message-success').addClass('visible');
							$parent.find('[data-pafe-form-builder-trigger-success]').trigger('click');
						} else {
							$parent.find('.pafe-form-builder-alert--mail .elementor-message-danger').addClass('visible');
							$(document).find('[data-pafe-form-builder-form-id="' + formID + '"]').closest('.elementor-element').css({'opacity' : 1});
							$(this).closest('.elementor-element').css({'opacity' : 1});
							$parent.find('[data-pafe-form-builder-trigger-failed]').trigger('click');

							if (responseArray.register_message != '') {
								$parent.find('.pafe-form-builder-alert--mail .elementor-message-danger').html(responseArray.register_message.replace(/###/g, ','));
							}
						}
					}

					//console.log(response);
					  // $( 'body' ).trigger( 'update_checkout' );
					// $( 'body' ).trigger( 'wc_update_cart' );


					
					if ($parent.find('input[name="redirect"]').length != 0) {
						var href = $parent.find('input[name="redirect"]').val().trim();
						var open_tab = $parent.find('input[name="redirect"]').attr('data-pafe-form-builder-open-new-tab');
						if (response.indexOf(',') !== -1) {
							if (responseArray.failed_status != '1') {
								if (responseArray.post_url != '' && href=='[post_url]') {
									window.location.href = responseArray.post_url;
								} else {
									if (responseArray.redirect != '') {
										if (open_tab =='yes') {
											window.open(responseArray.redirect, "_blank");
										} else {
											window.location.href = responseArray.redirect;
											} 	
		
									}
								}
							}
						}
					}

					// Popup
					if ($(document).find('[data-pafe-form-builder-popup][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
						$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
					}
					if(responseArray.popup){
						if ($(document).find('[data-pafe-form-builder-popup-open][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
							$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
						}
					}

					if ($(document).find('[data-pafe-form-builder-popup-close][data-pafe-form-builder-hidden-form-id="'+ formID +'"]').length != 0) {
						$submit.closest('.elementor-widget-container').find('[data-pafe-form-builder-hidden-form-id="'+ formID +'"]').trigger('click');
					}
				}
			});
			localStorage.removeItem('pafe_data_form_mollie_payment');
		}
	}
});

jQuery(document).ready(function($) {
	$.applyDataMask();

	function resizeSignature() {
    	$(document).find('[data-pafe-signature] canvas').each(function(){
    		var width = parseInt( $(this).css('max-width').replace('px','') ),
    			height = parseInt( $(this).css('height').replace('px','') ),
    			widthOuter = parseInt( $(this).closest('.elementor-form-fields-wrapper').width() ); 

			if(widthOuter > 0) {
				if (width > widthOuter || Number.isNaN(width)) {
					$(this).attr('width',widthOuter);
				} else {
					$(this).attr('width',width);
				}
				$(this).attr('height',$(this).css('height'));
			}
			
    	});
    }

    function pafeConditionalLogicFormCheck($conditionalsSeclector) {
        $conditionalsSeclector.each(function(){
            var $fieldGroup = $(this), 
				notField = $(this).data('pafe-form-builder-conditional-logic-not-field'),
				speed = $fieldGroup.data('pafe-form-builder-conditional-logic-speed'),
                easing = $fieldGroup.data('pafe-form-builder-conditional-logic-easing'),
                conditionals = $fieldGroup.data('pafe-form-builder-conditional-logic'),
                showAction = true,
                $repeater = $(this).closest('[data-pafe-form-builder-repeater-id]');

            if (!conditionals) {
				return;
            }

			if (notField != undefined) {
				var $fieldWidget = $(this),
					popupLength = $fieldWidget.closest('.elementor-location-popup').length,
					$fieldCurrent = $(this),
					formID = $fieldCurrent.data('pafe-form-builder-conditional-logic-not-field-form-id');

			} else {
				var $fieldWidget = $(this).closest('.elementor-element'),
					popupLength = $fieldWidget.closest('.elementor-location-popup').length,
					$fieldCurrent = $fieldGroup.find('[data-pafe-form-builder-form-id]'),
					formID = $fieldCurrent.data('pafe-form-builder-form-id');
			}

			var hasChanged = false;

			if ($(this).closest('.pafe-multi-step-form__content-item-button').length > 0) {
				hasChanged = true;
				$fieldWidget = $(this).closest('.pafe-multi-step-form__content-item-button');
				$fieldWidget.find('[data-pafe-form-builder-conditional-logic]').css({'display': 'block'});
			}

			var conditionalsStringify = JSON.stringify(conditionals);
			if (conditionalsStringify.indexOf('pafe') !== -1 && conditionalsStringify.indexOf('show') == -1) {
				showAction = false;
			}

			if (notField != undefined) {
				showAction = true;
				var fieldName = 1;
			} else {
				var fieldName = $fieldCurrent.attr('name').replace('[]','').replace('form_fields[','').replace(']','');
			}

			var error = 0,
				conditionalsCount = 0,
				conditionalsAndOr = '',
				indexConditonalRight = -1,
				setValue = '';

			for (var i = 0; i < conditionals.length; i++) {
				if (notField != undefined) {
					var show = 1;
				} else {
					var show = $fieldCurrent.attr('name').replace('form_fields[','').replace('[]','').replace(']','');
				}

				var fieldIf = conditionals[i]['pafe_conditional_logic_form_if'].trim().replace('[field id="','').replace('"]',''),
					comparison = conditionals[i]['pafe_conditional_logic_form_comparison_operators'],
					value = conditionals[i]['pafe_conditional_logic_form_value'],
					type = conditionals[i]['pafe_conditional_logic_form_type'],
					errorCurrent = error;
				if (type == 'number') {
					value = parseFloat( value );
				}

				if(fieldName == show) {
					conditionalsCount++;
					conditionalsAndOr = conditionals[i]['pafe_conditional_logic_form_and_or_operators'];
					if(fieldIf != '') {

						if ($repeater.length > 0) {
							var $fieldIfSelector = $repeater.find('[name="form_fields[' + fieldIf + ']"][data-pafe-form-builder-form-id="' + formID + '"]');
							if ($fieldIfSelector.length == 0) {
								var $fieldIfSelector = $(document).find('[name="form_fields[' + fieldIf + ']"][data-pafe-form-builder-form-id="' + formID + '"]');
							}
						} else {
							var $fieldIfSelector = $(document).find('[name="form_fields[' + fieldIf + ']"][data-pafe-form-builder-form-id="' + formID + '"]');
						}

						var fieldIfType = $fieldIfSelector.attr('type');

						if($fieldIfSelector.length > 0) {

							if (fieldIfType == 'radio' || fieldIfType == 'checkbox') {
								if ($repeater.length > 0) {
									var fieldIfValue = $repeater.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + ']"]:checked').val();
								} else {
									var fieldIfValue = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + ']"]:checked').val();
								}

							} else {
								var fieldIfValue = $fieldIfSelector.val();
							}

							if (fieldIfValue != undefined && fieldIfValue.indexOf(';') !== -1) {
								fieldIfValue = fieldIfValue.split(';');
								fieldIfValue = fieldIfValue[0];
							}

							if (type == 'number') {
								if (fieldIfValue == undefined) {
									fieldIfValue = 0;
								} else {
									fieldIfValue = parseFloat( fieldIfValue );
									if (isNaN(fieldIfValue)) {
										fieldIfValue = 0;
									}
								}
							}

							if(comparison == 'not-empty') {
								if (fieldIfValue == '' || fieldIfValue == 0) {
									error += 1;
								}
							}
							if(comparison == 'empty') {
								if (fieldIfValue != '' || fieldIfValue != 0) {
									error += 1;
								}
							}
							if(comparison == '=') {
								if (fieldIfValue != value) {
									error += 1;
								}
							}
							if(comparison == '!=') {
								if (fieldIfValue == value) {
									error += 1;
								}
							}
							if(comparison == '>') {
								if (fieldIfValue <= value) {
									error += 1;
								}
							}
							if(comparison == '>=') {
								if (fieldIfValue < value) {
									error += 1;
								}
							}
							if(comparison == '<') {
								if (fieldIfValue >= value) {
									error += 1;
								}
							}
							if(comparison == '<=') {
								if (fieldIfValue > value) {
									error += 1;
								}
							}
							if(comparison == 'unchecked') {
								if ($fieldIfSelector.prop('checked')) {
									error += 1;
								}
							}
							if(comparison == 'checked') {
								let checked  = false;
								$.each($fieldIfSelector, function(){
									if($(this).prop('checked')){
										checked = true;
									}
								});
								if (!checked) {
									error += 1;
								}
							}
							if(comparison == 'contains') {
								if (!fieldIfValue || fieldIfValue.indexOf(value) === -1) {
									error += 1;
								}
							}
						}

						if ($repeater.length > 0) {
							var $fieldIfSelectorMultiple = $repeater.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]');
							if ($fieldIfSelectorMultiple.length == 0) {
								var $fieldIfSelectorMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]');
							}
						} else {
							var $fieldIfSelectorMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]');
						}

						if($fieldIfSelectorMultiple.length > 0) {
							if ($repeater.length > 0) {
								var fieldIfTypeMultiple = $repeater.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]').attr('type');
							} else {
								var fieldIfTypeMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]').attr('type');
							}

							var fieldIfValueMultiple = $fieldIfSelectorMultiple.val(),
								fieldIfValueMultiple = [];

							if (fieldIfTypeMultiple == 'checkbox') {
								if ($repeater.length > 0) {
									$repeater.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]:checked').each(function () {
										fieldIfValueMultiple.push( $(this).val() );
									});
								} else {
									$(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldIf + '][]"]:checked').each(function () {
										fieldIfValueMultiple.push( $(this).val() );
									});
								}

							} else {
								fieldIfValueMultiple = $fieldIfSelectorMultiple.val();
								if (fieldIfValueMultiple == null) {
									var fieldIfValueMultiple = [];
								}
							}
							if(comparison == 'checked') {
								if(fieldIfValueMultiple.length <= 0){
									error += 1;
								}
							}
							if(comparison == 'unchecked') {
								if(fieldIfValueMultiple.length > 0){
									error += 1;
								}
							}
							if(comparison == 'not-empty') {
								if (fieldIfValueMultiple.length == 0) {
									error += 1;
								}
							}
							if(comparison == 'empty') {
								if (fieldIfValueMultiple.length > 0) {
									error += 1;
								}
							}
							if(comparison == '=' || comparison == '!=' || comparison == '>' || comparison == '>=' || comparison == '<' || comparison == '<=') {
								if (fieldIfValueMultiple.length == 0) {
									error += 1;
								}
							}
							if(comparison == '=') {
								for (var j = 0; j < fieldIfValueMultiple.length; j++) {
									if (fieldIfValueMultiple[j] != value) {
										error += 1;
									}
								}
							}
							if(comparison == '!=') {
								for (var j = 0; j < fieldIfValueMultiple.length; j++) {
									if (fieldIfValueMultiple[j] == value) {
										error += 1;
									}
								}
							}
							if(comparison == '>') {
								for (var j = 0; j < fieldIfValueMultiple.length; j++) {
									if (fieldIfValueMultiple[j] <= value) {
										error += 1;
									}
								}
							}
							if(comparison == '>=') {
								for (var j = 0; j < fieldIfValueMultiple.length; j++) {
									if (fieldIfValueMultiple[j] < value) {
										error += 1;
									}
								}
							}
							if(comparison == '<') {
								for (var j = 0; j < fieldIfValueMultiple.length; j++) {
									if (fieldIfValueMultiple[j] >= value) {
										error += 1;
									}
								}
							}
							if(comparison == '<=') {
								for (var j = 0; j < fieldIfValueMultiple.length; j++) {
									if (fieldIfValueMultiple[j] > value) {
										error += 1;
									}
								}
							}
							if(comparison == 'contains') {
								if (fieldIfValueMultiple.join().indexOf(value) === -1) {
									error += 1;
								}
							}
						}
					}
				}

				var $setValueForSelector = $fieldCurrent;

				if (errorCurrent == error) {
					if(conditionals[i] != undefined ) {
						if (conditionals[i]['pafe_conditional_logic_form_set_value'] != undefined && conditionals[i]['pafe_conditional_logic_form_action'].indexOf('set_value') !== -1 ) {
							setValue = conditionals[i]['pafe_conditional_logic_form_set_value'];

							if (conditionals[i]['pafe_conditional_logic_form_set_value_for'] != undefined && conditionals[i]['pafe_conditional_logic_form_set_value_for'] != '') {

								if ($repeater.length > 0) {
									var $setValueForSelector = $repeater.find('[data-pafe-form-builder-form-id="' + formID + '"][name^="form_fields[' + conditionals[i]['pafe_conditional_logic_form_set_value_for'] + ']"]');
									var valueSetSelector = $repeater.find('[data-pafe-form-builder-form-id="' + formID + '"][name^="form_fields[' + conditionals[i]['pafe_conditional_logic_form_set_value'] + ']"]').val();
								} else {
									var $setValueForSelector = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name^="form_fields[' + conditionals[i]['pafe_conditional_logic_form_set_value_for'] + ']"]');
									var valueSetSelector = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name^="form_fields[' + conditionals[i]['pafe_conditional_logic_form_set_value'] + ']"]').val();
								}
								if(valueSetSelector == undefined){
									valueSetSelector = conditionals[i]['pafe_conditional_logic_form_set_value'];
								}
							} else {
								var $setValueForSelector = $fieldCurrent;
								var setValueForThis = true;
							}
						}
					}
				}
			}

			var checkSelect = $fieldCurrent.find('option:first');

			var checkRadioCheckbox = false;

			if ($setValueForSelector.attr('type') == 'radio' || $setValueForSelector.attr('type') == 'checkbox') {
				checkRadioCheckbox = true;
			}

			var defaultValue = $fieldCurrent.data('pafe-form-builder-default-value');

			var isPassConditional = (conditionalsAndOr == 'or' && conditionalsCount > error) || (conditionalsAndOr == 'and' && error == 0);
			if (isPassConditional) {
				if (popupLength > 0) {
					if($fieldCurrent.attr('type') != 'hidden') {
						if ($fieldWidget.hasClass('pafe-form-builder-conditional-logic-hidden')) {
							hasChanged = true;
							$fieldWidget.show().removeClass('pafe-form-builder-conditional-logic-hidden');
						}
					} else {
						if ($fieldCurrent.attr('data-date-format') !== undefined) {
							if ($fieldWidget.hasClass('pafe-form-builder-conditional-logic-hidden')) {
								hasChanged = true;
								$fieldWidget.show().removeClass('pafe-form-builder-conditional-logic-hidden');
							}
						}
					}

					$setValueForSelector.each(function(){
						if (setValue != '' && checkRadioCheckbox ) {
							if (setValue == $(this).val()) {
								if ($(this).prop('checked') !== true) {
									hasChanged = true;
									$(this).prop('checked', true);
									//$(this).change();
								}
							}

							if (setValue == 'unchecked' || setValue == 'checked') {
								if (setValue == 'unchecked') {
									if ($(this).prop('checked') !== false) {
										hasChanged = true;
										$(this).prop('checked', false);
										//$(this).change();
									}
								} else {
									if ($(this).prop('checked') !== true) {
										hasChanged = true;
										$(this).prop('checked', true);
										//$(this).change();
									}
								}
							} else {
								if (setValue == $(this).val()) {
									if ($(this).prop('checked') !== true) {
										hasChanged = true;
										$(this).prop('checked', true);
										//$(this).change();
									}
								}
							}
						}

						if (setValue != '' && !checkRadioCheckbox) {
							var valueSet = conditionalsAndOr == 'or' ? valueSetSelector : setValue;
							if ($(this).val() !== valueSet) {
								hasChanged = true;
								$(this).val(valueSet);
								//$(this).change();
							}
						}
					});
				} else {
					if($fieldCurrent.attr('type') != 'hidden') {
						$paypal_element_button = $fieldWidget.closest('.elementor-widget-pafe-form-builder-submit').find('.pafe-form-builder-paypal');
						if($paypal_element_button.length > 0){
							if ($paypal_element_button.hasClass('pafe-form-builder-conditional-logic-hidden') || $paypal_element_button.css('display') !== 'block') {
								hasChanged = true;
								$paypal_element_button.slideDown(speed,easing, function() {
									$(this).attr('style', 'display: block;');
								}).removeClass('pafe-form-builder-conditional-logic-hidden');
							}
						}else{
							if ($fieldWidget.hasClass('pafe-form-builder-conditional-logic-hidden') || $fieldWidget.css('display') !== 'block') {
								hasChanged = true;
								$fieldWidget.slideDown(speed,easing, function() {
									$(this).attr('style', 'display: block;');
								}).removeClass('pafe-form-builder-conditional-logic-hidden');
							}
						}
					} else {
						if ($fieldCurrent.attr('data-date-format') !== undefined) {
							if ($fieldWidget.hasClass('pafe-form-builder-conditional-logic-hidden') || $fieldWidget.css('display') !== 'block') {
								hasChanged = true;
								$fieldWidget.slideDown(speed,easing, function() {
									$(this).attr('style', 'display: block;');
								}).removeClass('pafe-form-builder-conditional-logic-hidden');
							}
						}
					}

					$setValueForSelector.each(function(){
						if (setValue != '' && checkRadioCheckbox ) {
							if (setValue == $(this).val()) {
								if ($(this).prop('checked') !== true) {
									hasChanged = true;
									$(this).prop('checked', true);
									//$(this).change();
								}
							}

							if (setValue == 'unchecked' || setValue == 'checked') {
								if (setValue == 'unchecked') {
									if ($(this).prop('checked') !== false) {
										hasChanged = true;
										$(this).prop('checked', false);
										//$(this).change();
									}
								} else {
									if ($(this).prop('checked') !== true) {
										hasChanged = true;
										$(this).prop('checked', true);
										//$(this).change();
									}
								}
							} else {
								if (setValue == $(this).val()) {
									if ($(this).prop('checked') !== true) {
										hasChanged = true;
										$(this).prop('checked', true);
										//$(this).change();
									}
								}
							}
						}

						if (setValue != '' && !checkRadioCheckbox) {
							var valueSet = conditionalsAndOr == 'or' ? valueSetSelector : setValue;
							if ($(this).val() !== valueSet) {
								hasChanged = true;
								$(this).val(valueSet);
								//$(this).change();
							}
						}
					});
				}
			} else {
				if (popupLength > 0) {
					if (showAction) {
						if (!$fieldWidget.hasClass('pafe-form-builder-conditional-logic-hidden') || $fieldWidget.css('display') !== 'none') {
							hasChanged = true;
							$fieldWidget.hide().addClass('pafe-form-builder-conditional-logic-hidden');
						}

						if (notField != undefined) {
							var repeaterID = $fieldGroup.data('pafe-form-builder-repeater-id');

							if (repeaterID != undefined) {
								hasChanged = true;
								$fieldGroup.siblings('[data-pafe-form-builder-repeater-id="'+ repeaterID +'"]').remove();
							}

							var $fieldsInside = $fieldWidget.find('[data-pafe-form-builder-form-id]');

							$fieldsInside.each(function(){
								var checkSelect = $(this).find('option:first');

								var checkRadioCheckbox = false;

								if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
									checkRadioCheckbox = true;
								}

								var defaultValue = $(this).data('pafe-form-builder-default-value');

								if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
									if (checkRadioCheckbox) {
										var shouldCheck = defaultValue == $(this).val();
										if ($(this).prop('checked') !== shouldCheck || $(this).hasClass('pafe-checked') || $(this).hasClass('pafe-checked-setvalue')) {
											hasChanged = true;
											$(this).prop('checked', shouldCheck).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
										}
									} else {
										if ($(this).val() !== $(this).attr('data-pafe-form-builder-default-value')) {
											hasChanged = true;
											$(this).val(defaultValue);
										}
									}
								} else {
									if (checkSelect.length != 0) {
										if ($(this).val() !== checkSelect.val()) {
											hasChanged = true;
											$(this).val((checkSelect.val()));
										}
									} else {
										if (checkRadioCheckbox) {
											if ($(this).prop('checked') !== false || $(this).hasClass('pafe-checked') || $(this).hasClass('pafe-checked-setvalue')) {
												hasChanged = true;
												$(this).prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
											}
										} else {
											if ($(this).val() !== '') {
												hasChanged = true;
												$(this).val('');
											}
										}
									}
								}
							});
						}
					}

					if (notField == undefined) {
						if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
							if (checkRadioCheckbox) {
								var shouldCheck = defaultValue == $fieldCurrent.val();
								if ($fieldCurrent.prop('checked') !== shouldCheck || $fieldCurrent.hasClass('pafe-checked') || $fieldCurrent.hasClass('pafe-checked-setvalue')) {
									hasChanged = true;
									$fieldCurrent.prop('checked', shouldCheck).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
								}
							} else {
								if ($fieldCurrent.val() !== $fieldCurrent.attr('data-pafe-form-builder-default-value')) {
									hasChanged = true;
									$fieldCurrent.val(defaultValue);
								}
							}
						} else {
							if (checkSelect.length != 0) {
								if ($fieldCurrent.val() !== checkSelect.val()) {
									hasChanged = true;
									$fieldCurrent.val((checkSelect.val()));
								}
							} else {
								if (checkRadioCheckbox) {
									if ($fieldCurrent.prop('checked') !== false || $fieldCurrent.hasClass('pafe-checked') || $fieldCurrent.hasClass('pafe-checked-setvalue')) {
										hasChanged = true;
										$fieldCurrent.prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
										//$fieldCurrent.change();
									}
								} else {
									if ($fieldCurrent.val() !== '') {
										hasChanged = true;
										$fieldCurrent.val('');
										//$fieldCurrent.change();
									}
								}
							}
						}
					}
				} else {
					if (showAction) {
						$paypal_element_button = $fieldWidget.closest('.elementor-widget-pafe-form-builder-submit').find('.pafe-form-builder-paypal');
						if($paypal_element_button.length > 0){
							if (!$paypal_element_button.hasClass('pafe-form-builder-conditional-logic-hidden') || $paypal_element_button.css('display') !== 'none') {
								hasChanged = true;
								$paypal_element_button.slideUp(speed,easing).addClass('pafe-form-builder-conditional-logic-hidden');
							}
						}else{
							if (!$fieldWidget.hasClass('pafe-form-builder-conditional-logic-hidden') || $fieldWidget.css('display') !== 'none') {
								hasChanged = true;
								$fieldWidget.slideUp(speed,easing).addClass('pafe-form-builder-conditional-logic-hidden');
							}
						}

						if (notField != undefined) {
							var repeaterID = $fieldGroup.data('pafe-form-builder-repeater-id');
							if (repeaterID != undefined) {
								hasChanged = true;
								$fieldGroup.siblings('[data-pafe-form-builder-repeater-id="'+ repeaterID +'"]').remove();
							}

							var $fieldsInside = $fieldWidget.find('[data-pafe-form-builder-form-id]');

							$fieldsInside.each(function(){
								var checkSelect = $(this).find('option:first');

								var checkRadioCheckbox = false;

								if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
									checkRadioCheckbox = true;
								}

								var defaultValue = $(this).data('pafe-form-builder-default-value');

								if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
									if (checkRadioCheckbox) {
										var shouldCheck = defaultValue == $(this).val();
										if ($(this).prop('checked') !== shouldCheck || $(this).hasClass('pafe-checked') || $(this).hasClass('pafe-checked-setvalue')) {
											hasChanged = true;
											$(this).prop('checked', shouldCheck).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
										}
									} else {
										if ($(this).val() !== $(this).attr('data-pafe-form-builder-default-value')) {
											hasChanged = true;
											$(this).val(defaultValue);
										}
									}
								} else {
									if (checkSelect.length != 0) {
										if ($(this).val() !== checkSelect.val()) {
											hasChanged = true;
											$(this).val((checkSelect.val()));
										}
									} else {
										if (checkRadioCheckbox) {
											if ($(this).prop('checked') !== false || $(this).hasClass('pafe-checked') || $(this).hasClass('pafe-checked-setvalue')) {
												hasChanged = true;
												$(this).prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
											}
										} else {
											if ($(this).val() !== '') {
												hasChanged = true;
												$(this).val('');
											}
										}
									}
								}
							});

						}
					}

					if (notField == undefined) {
						if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
							if (checkRadioCheckbox) {
								var shouldCheck = defaultValue == $fieldCurrent.val();
								if ($fieldWidget.prop('checked') !== shouldCheck || $fieldWidget.hasClass('pafe-checked') || $fieldWidget.hasClass('pafe-checked-setvalue')) {
									hasChanged = true;
									$fieldCurrent.prop('checked', shouldCheck).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
								}
							} else {
								if ($fieldCurrent.val() !== $fieldCurrent.attr('data-pafe-form-builder-default-value')) {
									hasChanged = true;
									$fieldCurrent.val(defaultValue);
								}
							}
						} else {
							if (checkSelect.length != 0) {
								if ($fieldCurrent.val() !== checkSelect.val()) {
									hasChanged = true;
									$fieldCurrent.val((checkSelect.val()));
								}
							} else {
								if (checkRadioCheckbox) {
									if ($fieldCurrent.prop('checked') !== false || $fieldCurrent.hasClass('pafe-checked') || $fieldCurrent.hasClass('pafe-checked-setvalue')) {
										hasChanged = true;
										$fieldCurrent.prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
										//$fieldCurrent.change();
									}
								} else {
									if ($fieldCurrent.val() != '') {
										hasChanged = true;
										$fieldCurrent.val('');
									}
									//$fieldCurrent.change();
								}
							}
						}
					}
				}
			}

			if (hasChanged) {
				// console.log('hasChanged');

				var $repeaterParent = $(this).closest('[data-pafe-form-builder-repeater-form-id]');

				if ($repeaterParent.length > 0) {
					$repeaterCalculatedFields = $repeaterParent.find('[data-pafe-form-builder-calculated-fields]');

					$repeaterCalculatedFields.each(function(){
						var fieldName = $(this).attr('name').replace('[]','').replace('form_fields[','').replace(']','');
						pafeCalculatedFieldsForm(fieldName);
					});
				} else {
					pafeCalculatedFieldsForm('');
				}
			}

			if($(this).hasClass('elementor-field-type-signature') && $(this).closest('.elementor-widget-pafe-form-builder-field').hasClass('pafe-form-builder-conditional-logic-hidden')){
				resizeSignature();
			}
        });
    }

	function pafeScanConditionalLogic() {
		var $conditionals = $(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-conditional-logic]');
		if ($conditionals.length > 0) {
			pafeConditionalLogicFormCheck($conditionals);
		}
	}

	pafeScanConditionalLogic();

	$(document).on('keyup change','[data-pafe-form-builder-form-id]', $.debounce( 200, function(){
		pafeScanConditionalLogic();
		var $gridCarousel = $(document).find('[data-piotnetgrid-grid-carousel]');
		if ( $gridCarousel.length > 0 ) {
			$gridCarousel.trigger('grid_carousels');
		}
		})
	);

	$(document).on( 'elementor/popup/show', function(event, id, instance){
		pafeScanConditionalLogic();
	} );

	function FormatNumberBy3(num, decpoint, sep) {
		const parts = (num+"").split(".");
		var integerPart = Number(parts[0]).toLocaleString('en-US');
		var floatPart = "";
		if (parts.length > 1) {
			floatPart = "." + parts[1];
		}
		num = integerPart + floatPart;
		num = num.replace(/\./g, '|');
		num = num.replace(/\,/g, sep);
		num = num.replace(/\|/g, decpoint);
		return num;
	}

	function round(value, decimals, decimalsSymbol, seperatorsSymbol, decimalsShow) {
		var afterRound = Number(Math.round(value+'e'+decimals)+'e-'+decimals);
		if (decimalsShow == '') {
			return FormatNumberBy3( afterRound, decimalsSymbol, seperatorsSymbol );
		} else {
			var afterFixed = Number(afterRound.toFixed(decimals));
			var formattedNumber = FormatNumberBy3( afterFixed, decimalsSymbol, seperatorsSymbol );
			if (decimals > 0) {
				if (Number.isInteger(afterFixed)) {
					formattedNumber += decimalsSymbol + '0'.repeat(decimals);
				} else if (typeof(afterFixed) === 'number') {
					const decimalsCurrent = formattedNumber.length - formattedNumber.indexOf(decimalsSymbol) - 1;
					if(decimals -decimalsCurrent > 0){
						formattedNumber += '0'.repeat(decimals -decimalsCurrent);
					}
					
				}
			}
			return formattedNumber;
		}
	}

	function roundValue(value, decimals, decimalsShow) {
		var afterRound = Number(Math.round(value+'e'+decimals)+'e-'+decimals);
		if (decimalsShow == '') {
			return afterRound;
		} else {
			return Number(afterRound.toFixed(decimals));
		}
	}

	function evalWithVariables(func, vars) {
		try {
			return new Function("v", "with (v) { return (" + func +")}")(vars);
		} catch (err) {
			return undefined;
		}
	}

	function pafeCalculatedFieldsForm(fieldNameElement) {
		if (fieldNameElement === '' || !window['pafe-calculated-data']) {
			window['pafe-calculated-data'] = {} // clear calculated-data
		}
		const calculated_data = window['pafe-calculated-data'];

		var selector = '[data-pafe-form-builder-calculated-fields]';
		if (fieldNameElement != '') {
			fieldNameElement = '[field id="' + fieldNameElement + '"]';
			selector = "[data-pafe-form-builder-calculated-fields*='" + fieldNameElement + "'],[data-pafe-form-builder-calculated-fields-coupon-code='" + fieldNameElement + "']";
		}

        $(document).find(selector).each(function(){
            var $fieldWidget = $(this).closest('.elementor-element'),
            	$fieldCurrent = $(this),
            	formID = $fieldCurrent.data('pafe-form-builder-form-id'),
                calculation = $fieldCurrent.data('pafe-form-builder-calculated-fields'),
                roundingDecimals = $fieldCurrent.data('pafe-form-builder-calculated-fields-rounding-decimals'),
                decimalsSymbol = $fieldCurrent.data('pafe-form-builder-calculated-fields-rounding-decimals-decimals-symbol'),
                decimalsShow = $fieldCurrent.data('pafe-form-builder-calculated-fields-rounding-decimals-show'),
                separatorsSymbol = $fieldCurrent.data('pafe-form-builder-calculated-fields-rounding-decimals-seperators-symbol'),
                $repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]');
            if (calculation.indexOf('field id') == -1) {

	            // Loop qua tat ca field trong form
	            $(document).find('[name^="form_fields"][data-pafe-form-builder-form-id="' + formID + '"]').each(function(field_index, field_dom){

	                if ($(this).attr('id') != undefined) {
	                    var fieldName = $(this).attr('name').replace('[]','').replace('form_fields[','').replace(']',''),
	                        $fieldSelector = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + ']"]'),
	                        fieldType = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + ']"]').attr('type'),
	                        $repeater_field = $(this).closest('[data-pafe-form-builder-repeater-form-id]');

	                    if($fieldSelector.length > 0) {

	                        if (fieldType == 'radio' || fieldType == 'checkbox') {
	                        	if ($repeater_field.length > 0) {
		                        	var fieldValue = $(field_dom.closest('[data-pafe-form-builder-repeater-form-id]')).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + ']"]:checked').val();
		                        } else {
		                        	var fieldValue = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + ']"]:checked').val();
		                        }
	                        } else {
								if ($fieldSelector.val() !== null) {
									var fieldValue = $fieldSelector.val().trim();
								}
	                        }

	                        if (fieldValue == undefined) {
	                            fieldValue = 0;
	                        } else {
	                            fieldValue = parseFloatWithRemoveSepChar(fieldValue, separatorsSymbol, decimalsSymbol);
	                            if (isNaN(fieldValue)) {
	                                fieldValue = 0;
	                            }
	                        }

	                        if ($repeater_field.length > 0) {
	                        	var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + $repeater.data('pafe-form-builder-repeater-form-id') + '"]'),
									repeaterIndex = $repeater.index() - $repeaterAll.index();

								calculated_data['pafe_'+fieldName+'_piotnetpafe'+repeaterIndex+'x'] = fieldValue;
	                        } else {
								calculated_data[fieldName] = fieldValue;
	                        }
	                    }

	                    if (fieldName.indexOf('[]') !== -1) {
	                        fieldName = fieldName.replace('[]','');

	                        if ($repeater_field.length > 0) {
	                        	var $fieldSelectorMultiple = $repeater_field.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]');
	                        } else {
	                        	var $fieldSelectorMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]');
	                        }

	                        if($fieldSelectorMultiple.length > 0) {
	                            fieldTypeMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]').attr('type');
	                            var fieldValueMultiple = [];

	                            if (fieldTypeMultiple == 'checkbox') {
	                            	if ($repeater_field.length > 0) {
			                        	$repeater_field.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]:checked').each(function (index,element) {
		                                    fieldValueMultiple.push($(this).val());
		                                });
			                        } else {
			                        	$(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]:checked').each(function (index,element) {
		                                    fieldValueMultiple.push($(this).val());
		                                });
			                        }
	                                
	                            } else {
	                                fieldValueMultiple = $fieldSelectorMultiple.val();
	                                if (fieldValueMultiple == null) {
	                                    var fieldValueMultiple = [];
	                                }
	                            }

	                            var fieldValueMultipleTotal = 0;

	                            for (var j = 0; j < fieldValueMultiple.length; j++) {
	                                fieldValue = parseFloatWithRemoveSepChar(fieldValueMultiple[j], separatorsSymbol, decimalsSymbol);
	                                if (isNaN(fieldValue)) {
	                                    fieldValue = 0;
	                                }
	                                fieldValueMultipleTotal += fieldValue;
	                            }

	                            if ($repeater_field.length > 0) {
		                        	var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + $repeater.data('pafe-form-builder-repeater-form-id') + '"]'),
										repeaterIndex = $repeater.index() - $repeaterAll.index();

									calculated_data['pafe_'+fieldName+'_piotnetpafe'+repeaterIndex+'x'] = fieldValueMultipleTotal;
		                        } else {
									calculated_data[fieldName] = fieldValueMultipleTotal;
		                        }
	                            
	                        }
	                    }
	                }
	            });

            } else {
            	var fieldNameArray = calculation.match(/\"(.*?)\"/g);
            	if (fieldNameArray != null) {
	            	for (var jx = 0; jx<fieldNameArray.length; jx++) {
	            		var fieldNameSlug = fieldNameArray[jx].replace('"','').replace('"',''),
	            			$fieldSelectorExist = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name^="form_fields[' + fieldNameSlug + ']"]'),
	                        $fieldSelector = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldNameSlug + ']"]');

	                    if($fieldSelectorExist.length > 0) {  

	                    	var fieldName = $fieldSelectorExist.attr('name').replace('form_fields[','').replace(']',''),
		                        fieldType = $fieldSelectorExist.attr('type');

		                        //console.log(fieldName);

		                    if($fieldSelector.length >= 1 && $fieldSelector.closest('[data-pafe-form-builder-repeater-id]').length == 0) {

		                        if (fieldType == 'radio' || fieldType == 'checkbox') {
		                            var fieldValue = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + ']"]:checked').val();
		                        } else {
									if ($fieldSelector.val() !== null) {
										var fieldValue = $fieldSelector.val().trim();
									}
		                        }

		                        if (fieldValue == undefined) {
		                            fieldValue = 0;
		                        } else {
		                            fieldValue = parseFloatWithRemoveSepChar(fieldValue, separatorsSymbol, decimalsSymbol);
		                            if (isNaN(fieldValue)) {
		                                fieldValue = 0;
		                            }
		                        }

		                        if ($fieldSelector.attr('data-pafe-form-builder-date-range-days') != undefined) {
		                        	fieldValue = $fieldSelector.attr('data-pafe-form-builder-date-range-days');
		                        }

		                        if ($fieldSelector.attr('data-pafe-form-builder-date-calculate') != undefined) {
		                        	fieldValue = $fieldSelector.attr('data-pafe-form-builder-date-calculate');
		                        }

		                        if ($fieldSelector.attr('data-pafe-form-builder-form-booking-price') != undefined) {
		                        	fieldValue = $fieldSelector.attr('data-pafe-form-builder-form-booking-price');
		                        }

								calculated_data[fieldName] = parseFloatWithRemoveSepChar(fieldValue, separatorsSymbol, decimalsSymbol);

		                        if ($fieldSelector.closest('[data-pafe-form-builder-conditional-logic]').length > 0 && $fieldSelector.closest('.elementor-element').css('display') == 'none') {
									calculated_data[fieldName] = 0;
		                        }
		                    }

		                    if($fieldSelector.length > 1 || $fieldSelector.length == 1 && $fieldSelector.closest('[data-pafe-form-builder-repeater-id]').length > 0) {
		                    	$repeater_field = $fieldSelector.closest('[data-pafe-form-builder-repeater-id]');
		                    	if ($repeater_field.length > 0) {
			                    	$fieldSelector.each(function(field_index, field_dom){
			                    		if (fieldType == 'radio' || fieldType == 'checkbox') {
				                            var fieldValue = $(field_dom.closest('[data-pafe-form-builder-repeater-id]')).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + ']"]:checked').val();
				                        } else {
				                            var fieldValue = $(this).val().trim();
				                        }

				                        if (fieldValue == undefined) {
				                            fieldValue = 0;
				                        } else {
				                            fieldValue = parseFloatWithRemoveSepChar(fieldValue, separatorsSymbol, decimalsSymbol);
				                            if (isNaN(fieldValue)) {
				                                fieldValue = 0;
				                            }
				                        }

				                        if ($(this).attr('data-pafe-form-builder-date-range-days') != undefined) {
				                        	fieldValue = $(this).attr('data-pafe-form-builder-date-range-days');
				                        }

			                        	var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + $repeater.data('pafe-form-builder-repeater-form-id') + '"]'),
											repeaterIndex = $(this).closest('[data-pafe-form-builder-repeater-id]').index() - $repeaterAll.index();

										if ($(this).closest('[data-pafe-form-builder-conditional-logic]').length > 0 && $(this).closest('.elementor-element').css('display') == 'none') {
				                        	fieldValue = 0;
				                        }

										calculated_data['pafe_'+fieldName+'_piotnetpafe'+repeaterIndex+'x'] = parseFloatWithRemoveSepChar(fieldValue, separatorsSymbol, decimalsSymbol);
			                    	});
		                    	}
		                    }

		                    if (fieldName.indexOf('[]') !== -1) {

		                        fieldName = fieldName.replace('[]','');
		                        var $fieldSelectorMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]'),
		                        	fieldTypeMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]').attr('type');

	                        	$repeater_field = $(this).closest('[data-pafe-form-builder-repeater-id]');

		                        if($fieldSelectorMultiple.length == 1 || $fieldSelectorMultiple.length > 1 && $repeater_field.length == 0) {
		                            var fieldValueMultiple = [];
		                            if (fieldTypeMultiple == 'checkbox') {
		                                $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]:checked').each(function (index,element) {
					                        if ($(this).attr('data-pafe-form-builder-form-booking-price') != undefined) {
					                        	fieldValueMultiple.push( $(this).attr('data-pafe-form-builder-form-booking-price') );
					                        } else {
					                        	fieldValueMultiple.push($(this).val());
					                        }
		                                });
		                            } else {
		                                fieldValueMultiple = $fieldSelectorMultiple.val();
		                                if (fieldValueMultiple == null) {
		                                    var fieldValueMultiple = [];
		                                }
		                            }

		                            var fieldValueMultipleTotal = 0;

		                            for (var j = 0; j < fieldValueMultiple.length; j++) {
		                                fieldValue = parseFloatWithRemoveSepChar(fieldValueMultiple[j], separatorsSymbol, decimalsSymbol);
		                                if (isNaN(fieldValue)) {
		                                    fieldValue = 0;
		                                }
		                                fieldValueMultipleTotal += fieldValue;
		                            }
		                            if ($fieldSelectorMultiple.closest('[data-pafe-form-builder-conditional-logic]').length > 0 && $fieldSelectorMultiple.closest('.elementor-element').hasClass('pafe-form-builder-conditional-logic-hidden')) {
										fieldValueMultipleTotal = 0;
										let fieldAttr = $fieldSelectorMultiple.attr('data-pafe-form-builder-image-select');
										if(typeof fieldAttr !== 'undefined' && fieldAttr !== false){
											$fieldSelectorMultiple.imagepicker({show_label: true});
										}
			                        }

									calculated_data[fieldName] = fieldValueMultipleTotal;
		                        }

		                        if ($repeater_field.length > 0) {

		                        	if($fieldSelectorMultiple.length > 1 || $fieldSelectorMultiple.length == 1 && $repeater_field.length) {

		                        		$fieldSelectorMultiple = $repeater_field.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]');
 
			                    		$fieldSelectorMultiple.each(function(){
				                    		fieldTypeMultiple = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]').attr('type');
				                            var fieldValueMultiple = [];

				                            if (fieldTypeMultiple == 'checkbox') {
				                                $repeater_field.find('[data-pafe-form-builder-form-id="' + formID + '"][name="form_fields[' + fieldName + '][]"]:checked').each(function (index,element) {
				                                    fieldValueMultiple.push($(this).val());
				                                });
				                            } else {
				                                fieldValueMultiple = $fieldSelectorMultiple.val();
				                                if (fieldValueMultiple == null) {
				                                    var fieldValueMultiple = [];
				                                }
				                            }

				                            fieldValueMultipleTotal = 0;

				                            for (var j = 0; j < fieldValueMultiple.length; j++) {
				                                fieldValue = parseFloatWithRemoveSepChar(fieldValueMultiple[j], separatorsSymbol, decimalsSymbol);
				                                if (isNaN(fieldValue)) {
				                                    fieldValue = 0;
				                                }
				                                fieldValueMultipleTotal += fieldValue;
				                            }

				                        	var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + $repeater.data('pafe-form-builder-repeater-form-id') + '"]'),
												repeaterIndex = $(this).closest('[data-pafe-form-builder-repeater-id]').index() - $repeaterAll.index();

											if ($(this).closest('[data-pafe-form-builder-conditional-logic]').length > 0 && $(this).closest('.elementor-element').css('display') == 'none') {
					                        	fieldValueMultipleTotal = 0;
					                        }

											calculated_data['pafe_'+fieldName+'_piotnetpafe'+repeaterIndex+'x'] = fieldValueMultipleTotal;
				                    	});
			                    	}
			                    }
		                    }
	                    }
	            	}
            	}
            }

            var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'),
				repeaterIndex = $(this).closest('[data-pafe-form-builder-repeater-id]').index() - $repeaterAll.index();

            if ($repeaterAll.length > 0) {

	            var keyValues = [], global = window; // window for browser environments

	            for (var prop in calculated_data) {
					if (prop.indexOf('piotnet_') == 0) {
						calculated_data[prop] = 0;
						
					}
				}

				for (var prop in calculated_data) {
					if (prop.indexOf('pafe_') == 0) {
						var propArray = prop.split('_piotnetpafe');
						var propNew = propArray[0].replace('pafe_','piotnet_');
						if (calculated_data[propNew] == null) { // TODO not in
							calculated_data[propNew] = 0;
						}
						calculated_data[propNew] += calculated_data[prop];
					}
				}

				for (var prop in calculated_data) {
					if (prop.indexOf('piotnet_') == 0) {
						var propNew = prop.replace('piotnet_','');
						calculated_data[propNew] = calculated_data[prop];
					}
				}
			}

			var fieldNameArray = calculation.match(/\"(.*?)\"/g);
			if (fieldNameArray != null) {
				for (var jx = 0; jx<fieldNameArray.length; jx++) {
					var fieldName = fieldNameArray[jx].replace('"','').replace('"',''); 
					
					$fieldCalc = $(document).find('[data-pafe-form-builder-repeater-id] [data-pafe-form-builder-calculated-fields][name="form_fields[' + fieldName + ']"]');
					if ($fieldCalc.length > 0) {
						fieldCalcTotal = 0;
						var sectionNumbers = [];
						$fieldCalc.each(function(){
							var sectionNumber = $(this).closest('[data-pafe-form-builder-repeater-form-id="'+formID+'"]').attr('data-pafe-form-builder-repeater-number');

							if (sectionNumbers.indexOf(sectionNumber) < 0) {
								sectionNumbers.push(sectionNumber);
								fieldCalcTotal += parseFloatWithRemoveSepChar($(this).val(), separatorsSymbol, decimalsSymbol);
							}
						});
						var find = fieldName;
						var re = new RegExp(find, 'g');
						var calculation = calculation.replace(re, fieldCalcTotal);
					}
				}
			}

			if ($repeaterAll.length > 0) {
				for (var prop in calculated_data) {
					if (prop.indexOf('pafe_') == 0 && prop.indexOf('_piotnetpafe'+repeaterIndex+'x') !== -1 ) {
						var propArray = prop.split('_piotnetpafe');
						var fieldNameArraySplit = propArray[0].split('pafe_');
						var find = fieldNameArraySplit[1];
						var re = new RegExp(find, 'g');
						var calculation = calculation.replace(re, prop);
					}
				}
			}

			

			if (fieldNameArray != null) {
				for (var jx = 0; jx<fieldNameArray.length; jx++) {
					var fieldName = fieldNameArray[jx].replace('"','').replace('"',''); 
					
					if (calculated_data[fieldName] == undefined) {
						calculated_data[fieldName] = 0;
					}
				}
			}

            var calculation = calculation
				.replace(/\[field id=/g, '')
				.replace(/\"]/g, '')
				.replace(/\"/g, '')
				.replace(/--/g, '+');

            var totalFieldContent = evalWithVariables(calculation, calculated_data);

        	if ($(this).attr('data-pafe-form-builder-calculated-fields-coupon-code') != undefined) {
        		var $couponCodeFields = $(document).find('[name="form_fields[' + $(this).attr('data-pafe-form-builder-calculated-fields-coupon-code').replace('[field id="','').replace('"]','') + ']"]' );
        		if ($couponCodeFields.length > 0) {
        			var $couponCodeField = $couponCodeFields.eq(0);

					var code_list = $couponCodeField.attr('data-pafe-coupon-code-list');
					if (code_list === undefined) {
						code_list = '[]';
					}
        			var couponObj = JSON.parse( code_list );

        			for (var couponIndex = 0; couponIndex<couponObj.length; couponIndex++) {
						var couponItem = couponObj[couponIndex];
						if ($couponCodeField.val() == couponItem.pafe_coupon_code) {
							if (couponItem.pafe_coupon_code_discount_type == 'percentage') {
								totalFieldContent = totalFieldContent*parseFloat((100-couponItem.pafe_coupon_code_coupon_amount)/100);
							}
							if (couponItem.pafe_coupon_code_discount_type == 'flat_amount') {
								totalFieldContent = totalFieldContent - parseFloat(couponItem.pafe_coupon_code_coupon_amount);
							}
						}
					}
        		}
        	}

        	if (!isNaN(totalFieldContent)) {
        		$fieldWidget.find('.pafe-calculated-fields-form__value').html(round(totalFieldContent, roundingDecimals, decimalsSymbol, separatorsSymbol, decimalsShow).replace('NaN',0));

				var oldVal = $fieldCurrent.val();
				var newVal = roundValue(totalFieldContent, roundingDecimals, decimalsShow);
	        	$fieldCurrent.val(newVal);
				if (oldVal !== $fieldCurrent.val()) {
					if ($fieldCurrent.closest('.pafe-form-builder-conditional-logic-hidden').length > 0 && oldVal == '') {
						// Pass
					} else {
						$fieldCurrent.change();
					}

					var fieldNameCalc = $(this).attr('name').replace('[]','').replace('form_fields[','').replace(']','');
					pafeCalculatedFieldsForm(fieldNameCalc);
				}
        	}

        });
    }

    pafeCalculatedFieldsForm('');

	$(document).on('keyup change','[data-pafe-form-builder-form-id]', $.debounce( 200, function(){
		var fieldName = $(this).attr('name').replace('[]','').replace('form_fields[','').replace(']','');
		pafeCalculatedFieldsForm(fieldName);
	})
	);

	function IDGenerator() {
	 
		 this.length = 8;
		 this.timestamp = +new Date;
		 
		 var _getRandomInt = function( min, max ) {
			return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
		 }
		 
		 this.generate = function() {
			 var ts = this.timestamp.toString();
			 var parts = ts.split( "" ).reverse();
			 var id = "";
			 
			 for( var i = 0; i < this.length; ++i ) {
				var index = _getRandomInt( 0, parts.length - 1 );
				id += parts[index];	 
			 }
			 
			 return id;
		 }

		 
	 }

	$(document).on('keyup change','[data-pafe-form-builder-image-upload]', function(){

		var $label = $(this).closest('label'),
			$widget = $(this).closest('.elementor-element'),
			maxFiles = 1000;

		if ($label.attr('data-pafe-form-builder-image-upload-max-files') !== undefined) {
			maxFiles = parseInt($label.attr('data-pafe-form-builder-image-upload-max-files'));
			var currentFiles = $widget.find('.pafe-form-builder-image-upload-placeholder.pafe-form-builder-image-upload-uploaded:not(.pafe-form-builder-image-upload-delete)').length;
			maxFiles = maxFiles - currentFiles;
		}

		$.each($(this)[0].files, function(i, file){
			if (maxFiles > 0) {
				maxFiles = maxFiles - 1;

				var imgPath = file.name,
					extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
				if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
					if (typeof(FileReader) != "undefined") {

						if($label.attr('multiple') != 'multiple') {
							$label.hide(0);
						}

						var unique = new IDGenerator(),
							uniqueID = unique.generate();
					    var reader = new FileReader();
					    reader.onload = function(e) {
							image = new Image();
							image.src = e.target.result;
							$label.before('<div class="pafe-form-builder-image-upload-placeholder pafe-form-builder-image-upload-uploading" style="background-image:url('+e.target.result+')" data-pafe-form-builder-image-upload-placeholder="'+ uniqueID +'"><input type="text" style="display:none;" data-pafe-form-builder-image-upload-item><span class="pafe-form-builder-image-upload-button pafe-form-builder-image-upload-button--remove" data-pafe-form-builder-image-upload-button-remove><i class="fa fa-times" aria-hidden="true"></i></span><span class="pafe-form-builder-image-upload-button pafe-form-builder-image-upload-button--uploading" data-pafe-form-builder-image-upload-button-uploading><i class="fa fa-spinner fa-spin"></i></span></div>');
					    }
					    reader.readAsDataURL(file);

						var formData = new FormData();
						formData.append( 'upload', file);

						$.ajax({
						    url: $('[data-pafe-form-builder-tinymce-upload]').data('pafe-form-builder-tinymce-upload'),
						    type: "POST",
						    data: formData,
						    processData: false,
						    contentType: false,
						    success: function (response) {
								var obj = JSON.parse(response);
								var imageItem = $(document).find('[data-pafe-form-builder-image-upload-placeholder="' + uniqueID + '"]');
								if (imageItem.length == 1) {
									imageItem.removeClass('pafe-form-builder-image-upload-uploading').addClass('pafe-form-builder-image-upload-uploaded');
						    		imageItem.find('input').attr('value',obj.location);

						    		var imageUploadedURL = '';
						    		var $imageUploaded = $widget.find('[data-pafe-form-builder-image-upload-placeholder]:not(.pafe-form-builder-image-upload-delete) [data-pafe-form-builder-image-upload-item]');

									$imageUploaded.each(function(){
										imageUploadedURL += $(this).val() + ',';
									});

									imageUploadedURL = imageUploadedURL.replace(/.$/,"");

									$widget.find('[data-pafe-form-builder-form-id]').attr('value',imageUploadedURL);
									$widget.find('[data-pafe-form-builder-form-id]').val(imageUploadedURL); 
									$widget.find('[data-pafe-form-builder-form-id]').change(); 
								}
						    }
						});
					} else {
					  	alert("Your browser does not support");
					}
				}

				if (maxFiles == 0) {
					$label.hide(0);
				}
			} else {
				$label.hide(0);
			}
		});
	});

	$(document).on('click','[data-pafe-form-builder-image-upload-button-remove]', function(){
		var $placeholder = $(this).closest('.pafe-form-builder-image-upload-placeholder');
		$placeholder.css({'display':'none'});
		$placeholder.addClass('pafe-form-builder-image-upload-delete');

		var $widget = $(this).closest('.elementor-element');
		var $imageUploaded = $widget.find('[data-pafe-form-builder-image-upload-placeholder]:not(.pafe-form-builder-image-upload-delete) [data-pafe-form-builder-image-upload-item]');
		var imageUploadedURL = '';
		var $label = $widget.find('[data-pafe-form-builder-image-upload-label]');

		if ($imageUploaded.length == 0) {
			$label.show(0);
		}

		if($label.attr('multiple') == 'multiple') {
			$label.show(0);
		}

		$imageUploaded.each(function(){
			imageUploadedURL += $(this).val() + ',';
		});

		imageUploadedURL = imageUploadedURL.replace(/.$/,"");

		$widget.find('[data-pafe-form-builder-form-id]').val(imageUploadedURL);//attr('value',imageUploadedURL);
		$widget.find('[data-pafe-form-builder-form-id]').change();
	});

	$('[data-pafe-form-builder-form-id][type="hidden"]').each(function(){
		$(this).closest('.elementor-widget-pafe-form-builder-field').addClass('elementor-widget-pafe-form-builder-field-hidden');
	});

	// Repeater
	function generateRandomString(length) {
		var result           = '';
		var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for ( var i = 0; i < length; i++ ) {
		   result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		return result;
	}

	/* Check if Mobile */
	function checkIsMobile() {
	   return (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ); 
	}

    // Check Valid JSONS String 
    function isValidJSONString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

	$(document).on('click','[data-pafe-form-builder-repeater-form-id-trigger]', function(e){
		e.preventDefault();

		var formID = $(this).data('pafe-form-builder-repeater-form-id-trigger'),
			repeaterID = $(this).data('pafe-form-builder-repeater-id-trigger'),
			repeaterTriggerAction = $(this).data('pafe-form-builder-repeater-trigger-action'),
			$repeater = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + repeaterID + '"]');

		if (repeaterTriggerAction == 'add') {

			$(document).find('[data-pafe-form-builder-repeater-id="' + repeaterID + '"] [data-pafe-form-builder-repeater-trigger-action="remove"]').show();

			if ($repeater.length > 0) {

				if ($(this).closest('[data-pafe-form-builder-repeater-form-id]').length > 0) {
					$repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]').find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + repeaterID + '"]');
				}

				var repeaterLimit = $repeater.eq(0).attr('data-pafe-form-builder-repeater-limit');

				if (repeaterLimit == 0 || repeaterLimit > 0 && $repeater.eq($repeater.length - 1).siblings('[data-pafe-form-builder-repeater-id="' + repeaterID + '"]').length < repeaterLimit - 1) {

					if ($repeater.eq($repeater.length - 1).siblings('[data-pafe-form-builder-repeater-id="' + repeaterID + '"]').length == repeaterLimit-2) {
						$(this).hide();
					}

					$repeater.eq($repeater.length - 1).after($repeater.eq(0).prop('outerHTML'));
					var $repeaterNew = $repeater.eq($repeater.length - 1).next();
					$repeaterNew.attr('data-pafe-form-builder-repeater-number', generateRandomString(8));

					var $radioField = $repeaterNew.find('input[type="radio"]');
					$radioField.each(function(index,element){
						var id = $(this).attr('id');
						$(this).attr('id',id+$repeater.length+index);
						$(this).siblings('label').attr('for',id+$repeater.length+index);
					});

					var $checkboxField = $repeaterNew.find('input[type="checkbox"]');
					$checkboxField.each(function(index,element){
						var id = $(this).attr('id');
						$(this).attr('id',id+$repeater.length+index);
						$(this).siblings('label').attr('for',id+$repeater.length+index);
					});

					var $conditionals = $repeaterNew.find('[data-pafe-form-builder-conditional-logic]');
					if ($conditionals.length > 0) {
						pafeConditionalLogicFormCheck($conditionals);
					}

					$(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-conditional-logic][data-pafe-form-builder-form-id="'+ formID +'"]').change();

					var $imageUploadField = $repeaterNew.find('[data-pafe-form-builder-image-upload]');
					if ($imageUploadField.length > 0) {
						$imageUploadField.each(function(){
							$imageUploadedFieldWidget = $(this).closest('.elementor-element');
							$imageUploadedFieldWidget.find('[data-pafe-form-builder-image-upload-placeholder]').remove();
							$imageUploadedFieldWidget.find('[data-pafe-form-builder-image-upload-label]').show(0);
							$imageUploadedFieldWidget.find('[data-pafe-form-builder-form-id]').val('');
						});
					}

					$repeaterNew.find('[data-mask]').each(function(){
						$(this).mask($(this).attr('data-mask')); 
					});

					var $imageSelect = $repeaterNew.find('[data-pafe-form-builder-image-select]');
					if ($imageSelect.length > 0) {
						$imageSelect.each(function(){

							$(this).closest('.elementor-field').find('.image_picker_selector').remove();
							
							var gallery = $(this).data('pafe-form-builder-image-select'),
				                $options = $(this).find('option');

				            $(this).closest('.elementor-field').addClass('pafe-image-select-field');
				            var $imageSelectField = $(this);
				            
				            $options.each(function(index,element){
				            	if ($options.eq(0).attr('value').trim() == '' && index != 0) {
				            		var indexGallery = index - 1;
					                var imageURL = gallery[indexGallery]['url'],
					                    optionsContent = $(this).html();

					                $(this).attr('data-img-src',imageURL);
					                $imageSelectField.imagepicker({show_label: true});
					            }

					            if ($options.eq(0).attr('value').trim() != '') {
					                var imageURL = gallery[index]['url'],
					                    optionsContent = $(this).html();

					                $(this).attr('data-img-src',imageURL);
					                $imageSelectField.imagepicker({show_label: true});
					            }
				            });

						});
					}


					var $rangeSlider = $repeaterNew.find('[data-pafe-form-builder-range-slider]');

					if ($rangeSlider.length > 0) {
						$rangeSlider.each(function(){
							$(this).closest('.elementor-element').find('.irs').remove();

							var optionsString = $(this).data('pafe-form-builder-range-slider');
					        var options = {};
							var items = optionsString.split(',');
							for (var j = 0; j < items.length; j++) {
							    var current = items[j].trim().split(':');
							    if (current[0] != undefined && current[1] != undefined) {
							    	var current1 = current[1].trim().replace('"','').replace('"','');
							    	if (current1 == "false" || current1 == "true") {
							    		if (current1 == "false") {
							    			options[current[0]] = false;
							    		} else {
							    			options[current[0]] = true;
							    		}
							    	} else {
							    		options[current[0]] = current1;
							    	}
							    }
							}

							options.onStart = function (data) { 
					            //pafeConditionalLogicFormCheck();
					            //pafeCalculatedFieldsForm();
					        };

							$(this).ionRangeSlider(options);
							$(this).addClass('irs-hidden-input');
						});
					}

					var $niceNumber = $repeaterNew.find('[data-pafe-form-builder-spiner] .nice-number');
					if ($niceNumber.length > 0) {
						$niceNumber.each(function(){
							var $field = $(this).closest('[data-pafe-form-builder-spiner]'),
								$input = $(this).find('.elementor-field'),
								inputHTML = $input.prop('outerHTML');
							$(this).after(inputHTML);
							$(this).remove();
							$field.find('.elementor-field').niceNumber({
								autoSize: false,
							});
						});
					}

					var $repeaterSub = $repeaterNew.find('[data-pafe-form-builder-repeater-id]');
					if ($repeaterSub.length > 0) {
						pafeConditionalLogicFormCheck($repeaterSub);
						$repeaterSub.each(function(){
							var repeaterID = $(this).data('pafe-form-builder-repeater-id');
							$(this).siblings('[data-pafe-form-builder-repeater-id="'+ repeaterID +'"]').remove();
						});
					}

					var $fieldsInside = $repeaterNew.find('[data-pafe-form-builder-form-id]');

	    			$fieldsInside.each(function(){
	    				var checkSelect = $(this).find('option:first');

						var checkRadioCheckbox = false;

						if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
							checkRadioCheckbox = true;
						}

						var defaultValue = $(this).data('pafe-form-builder-default-value');

						if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
							if (checkRadioCheckbox) {
								defaultValue = $(this).attr('data-value');
								$(this).val(defaultValue).change();
							} else {
								$(this).val(defaultValue).change();
							}
	                	} else {
	                		if (checkSelect.length != 0) {
	            				$(this).val((checkSelect.val())).change();
	            			} else {
								if (checkRadioCheckbox) {
	            					$(this).prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
	            				} else {
	            					$(this).val('');
	            				}
	            			}
	                	}
	    			});

					var $selectAutocomplete = $repeaterNew.find('[data-pafe-form-builder-select-autocomplete]');
					if ($selectAutocomplete.length > 0) {
						$selectAutocomplete.each(function(){
							var options = JSON.parse($(this).attr('data-options'));
							var optionsHTML = '';

							for (var optionsIndex = 0; optionsIndex < options.length; optionsIndex++) {
								var option = options[optionsIndex];
								if (option.indexOf('|') >= 0) {
									option = option.split('|');
									optionsHTML += '<option value="' + option[1] + '">' + option[0] + '</option>';
								} else {
									optionsHTML += '<option value="' + option + '">' + option + '</option>';
								}
							}
							

							$(this).html(optionsHTML);
							$(this).closest('.elementor-field').find('.selectize-control').remove();

							$(this).selectize({
								dropdownParent: 'body',
							});
						}); 
					}

					var $dateField = $repeaterNew.find('.elementor-date-field');
					if ($dateField.length > 0 && !checkIsMobile()) {
						var addDatePicker = function addDatePicker($element) {
							if ($element.hasClass('elementor-use-native')) { 
								return;
							}

							var minDate = $($element).attr('min') ? flatpickr.parseDate($($element).attr('min'), "Y-m-d") : null,
								maxDate = $($element).attr('max') ? flatpickr.parseDate($($element).attr('max'), "Y-m-d") : null;

							var options = {
								minDate: minDate,
								maxDate: maxDate,
								dateFormat: $element.attr('data-date-format') || null,
								defaultDate: $element.attr('data-pafe-form-builder-value') || null,
								allowInput: true,
								animate: false,
								onReady: function(date) { 
									var day = parseInt( date[0] / (1000 * 60 * 60 * 24), 10);
									$element.attr('data-pafe-form-builder-date-calculate', day);
								},
								onClose: function(date) { 
									var day = parseInt( date[0] / (1000 * 60 * 60 * 24), 10);
									$element.attr('data-pafe-form-builder-date-calculate', day);
								}
							};

							if ($element.data('pafe-form-builder-date-range') != undefined) {
								var options = {
									minDate: minDate,
									maxDate: maxDate,
									dateFormat: $element.attr('data-date-format') || null,
									defaultDate: $element.attr('data-pafe-form-builder-value') || null,
									allowInput: true,
									animate: false,
									onClose: function(date) { 
										var startDay = flatpickr.formatDate(date[0], "m/d/Y");
										var endDay = flatpickr.formatDate(date[1], "m/d/Y");

										var newStartDate = new Date(startDay).getTime();
										var newEndDate = new Date(endDay).getTime();

										var newStartDate = eval( newStartDate / 1000 + 3600 ); // for GMT+1 I had to add 3600 (seconds) [1 hour]
										var newEndDate = eval( newEndDate / 1000 + 3600 ); // for GMT+1 I had to add 3600 (seconds) [1 hour]

										var countDays = eval( newEndDate - newStartDate );
										var countDays = eval( countDays / 86400 + 1 );

										$element.attr('data-pafe-form-builder-date-range-days', countDays);
									}
								};

								options['mode'] = 'range';
							}

							if ($element.data('pafe-form-builder-date-language') != 'english') { 
								options['locale'] = $element.attr('data-pafe-form-builder-date-language');
							}

                            if ($element.hasClass('flatpickr-custom-options')) {
                                if (isValidJSONString($element.attr('data-pafe-flatpickr-custom-options'))) {
                                   options = JSON.parse($element.attr('data-pafe-flatpickr-custom-options'));
                                } else {
                                   options = $element.attr('data-pafe-flatpickr-custom-options');
                                }
                            }

							$element.flatpickr(options);
						};

						$dateField.each(function(){
							addDatePicker($(this));
						});
					}

					window.pafeIntlTelInput = function (selector,countryCode) {
						if ( selector.length > 0 ) {
							selector.each(function(){
								$(this).intlTelInput({
									autoHideDialCode: true,
									autoPlaceholder: "off",
									dropdownContainer: document.body,
									formatOnDisplay: false,
									hiddenInput: "full_number",
									initialCountry: countryCode,
									nationalMode: false,
									preferredCountries: ['US'],
									separateDialCode: true,
									utilsScript: ''
								});
							})
							if ($('html').attr('dir') == 'rtl') {
								$('body').addClass('iti-rtl');
							}
						}
					}

					var $pafeTelField = $(document).find('[data-pafe-tel-field]');
					if ( $pafeTelField.length > 0 ) {
						let countryCode = '';
						let data = {
							'action': 'pafe_get_country_code',
						};
						$.ajax(ajaxurl,
							{
								data: data,
								timeout: 5000,
								success: function (response) {
									if(response != 'error'){
										countryCode = response;
									}
									pafeIntlTelInput($pafeTelField,countryCode);
								},
								error: function (e) {
									pafeIntlTelInput($pafeTelField,countryCode);
								}
							}
						);
					}

					var $timeField = $repeaterNew.find('.elementor-time-field');
					if ($timeField.length > 0 && !checkIsMobile()) {
						var addTimePicker = function addTimePicker($element) {
							if ($element.hasClass('elementor-use-native')) { 
								return;
							}
							$element.flatpickr({
								noCalendar: true,
								enableTime: true,
								allowInput: true,
								defaultDate: $element.attr('data-pafe-form-builder-value') || null,
							});
						};

						$timeField.each(function(){
							addTimePicker($(this));
						});
					}
				}

			}
		} else {
			$(document).find('[data-pafe-form-builder-repeater-id-trigger="' + repeaterID + '"]').show();

			if ($repeater.length == 2) {
				$(document).find('[data-pafe-form-builder-repeater-id="' + repeaterID + '"] [data-pafe-form-builder-repeater-trigger-action="' + repeaterTriggerAction + '"]').hide(); 
			}
			
			if ($repeater.length > 1) {
				var $repeaterParent = $(this).closest('[data-pafe-form-builder-repeater-form-id="' + formID + '"]');
				if ($repeaterParent.siblings('[data-pafe-form-builder-repeater-form-id="' + formID + '"]').length > 0) {
					$(this).closest('[data-pafe-form-builder-repeater-form-id="' + formID + '"]').remove();
				}

				var $conditionals = $(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-conditional-logic]');
				if ($conditionals.length > 0) {
					pafeConditionalLogicFormCheck($conditionals);
				}

				$(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-conditional-logic][data-pafe-form-builder-form-id="'+ formID +'"]').change();
				$(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-form-id="'+ formID +'"]').change();

				pafeCalculatedFieldsForm('');  
			}
		}

	});

	$('[data-pafe-form-builder-repeater-id]').each(function(){
		var formID = $(this).data('pafe-form-builder-repeater-form-id'),
			repeaterID = $(this).data('pafe-form-builder-repeater-id'),
			fieldEndRepeaterID = 'pafe-end-repeater' + repeaterID;

		$(this).after('<div class="elementor-element elementor-element-7d558e4 elementor-widget elementor-widget-pafe-form-builder-field elementor-widget-pafe-form-builder-field-hidden" data-element_type="widget" data-widget_type="pafe-form-builder-field.default" style="opacity: 0.45;"><div class="elementor-widget-container"><div class="elementor-form-fields-wrapper elementor-labels-above"><div class="elementor-field-type-hidden elementor-field-group elementor-column elementor-field-group-' + fieldEndRepeaterID + ' elementor-col-100"><div data-pafe-form-builder-required=""></div><input size="1" class="elementor-field elementor-size- " type="hidden" name="form_fields[' + fieldEndRepeaterID + ']" id="form-field-' + fieldEndRepeaterID + '" autocomplete="on" data-pafe-form-builder-default-value="" value="" data-pafe-form-builder-value="" data-pafe-form-builder-form-id="' + formID + '"></div></div></div></div>');
	});

	$('[data-pafe-form-builder-delete-post]').click(function(e){
		e.preventDefault();
    	var data = {
			'action': 'pafe_delete_post',
			'id': $(this).data('pafe-form-builder-delete-post'),
			'force_delete': $(this).data('pafe-form-builder-delete-post-force'),
		};

		var redirect = $(this).data('pafe-form-builder-delete-post-redirect');

        $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data, function(response) {
        	if (response.trim() != '') {
        		window.location.href = redirect;
        	}
		});
    });

    function setFieldValue($fieldCurrent, setValue) {
		var checkSelect = $fieldCurrent.find('option:first');

        var checkRadioCheckbox = false;

        if ($fieldCurrent.attr('type') == 'radio' || $fieldCurrent.attr('type') == 'checkbox') {
        	checkRadioCheckbox = true;
        }

        var checkImageUpload = $fieldCurrent.closest('.elementor-element').find('[data-pafe-form-builder-image-upload]');

        var defaultValue = $fieldCurrent.data('pafe-form-builder-default-value');
		
		$fieldCurrent.each(function(){
			if (setValue != '' && checkRadioCheckbox ) {
				var splValue = setValue.split(",");
				for (var i = 0; i < splValue.length; i++) {
					if (splValue[i] == $(this).val()) {
						$(this).prop('checked', true);
						//$(this).change();
					}
				}

				if (setValue == 'unchecked' || setValue == 'checked') {
					if (setValue == 'unchecked') {
						$(this).prop('checked', false);
						//$(this).change();
					} else {
						$(this).prop('checked', true);
						//$(this).change();
					}
				} else {
					if (setValue == $(this).val()) {
						$(this).prop('checked', true);
						//$(this).change();
					}
				}
			} 

			if (setValue != '' && !checkRadioCheckbox && checkSelect.length == 0) {
				if ($(this).hasClass('elementor-date-field')) {
					var checkUserProfile = $fieldCurrent.closest('.elementor-section').find('[data-pafe-form-builder-submit-update-user-profile]');
					if (checkUserProfile.length != 0) {
						$(this).attr('data-pafe-form-builder-value', setValue);
					} else {
						$(this).val(setValue);
					}
				} else {
					$(this).val(setValue);
				}
			}

			if (checkSelect.length != 0) {
				var $options = $(this).find('option');
				var $fieldSelector = $(this);
				$options.each(function(){
					if ($(this).attr('value') == setValue || $(this).html() == setValue) {
						$fieldSelector.val($(this).attr('value'));
						if ($fieldSelector.data('picker') != undefined) {
							$fieldSelector.data('picker').sync_picker_with_select();
						}
						
					}
				}); 
			}

			if (checkImageUpload.length != 0) {
				if (setValue != '' && setValue != null) {
					var images = setValue.split(',');
					var $label = $(this).closest('.elementor-element').find('[data-pafe-form-builder-image-upload-label]');

					if ($label.attr('multiple') == undefined) {
						$label.addClass('pafe-form-builder-image-upload-label-hidden');
					}
					
					for(var k in images) {
						$label.before('<div class="pafe-form-builder-image-upload-placeholder pafe-form-builder-image-upload-uploaded" style="background-image:url(' + images[k] + ')" data-pafe-form-builder-image-upload-placeholder=""><input type="text" style="display:none;" data-pafe-form-builder-image-upload-item value="' + images[k] + '"><span class="pafe-form-builder-image-upload-button pafe-form-builder-image-upload-button--remove" data-pafe-form-builder-image-upload-button-remove><i class="fa fa-times" aria-hidden="true"></i></span><span class="pafe-form-builder-image-upload-button pafe-form-builder-image-upload-button--uploading" data-pafe-form-builder-image-upload-button-uploading><i class="fa fa-spinner fa-spin"></i></span></div>');
					}
				}
			}

			$(this).change();
		}); 
	}

	function reInitFieldRepeater($repeaterNew) {
		$repeaterNew.attr('data-pafe-form-builder-repeater-number', generateRandomString(8));

		var $imageUploadField = $repeaterNew.find('[data-pafe-form-builder-image-upload]');
		if ($imageUploadField.length > 0) {
			$imageUploadField.each(function(){
				$imageUploadedFieldWidget = $(this).closest('.elementor-element');
				$imageUploadedFieldWidget.find('[data-pafe-form-builder-image-upload-placeholder]').remove();
				$imageUploadedFieldWidget.find('[data-pafe-form-builder-image-upload-label]').show(0);
				$imageUploadedFieldWidget.find('[data-pafe-form-builder-form-id]').val('');
			});
		}

		var $imageSelect = $repeaterNew.find('[data-pafe-form-builder-image-select]');
		if ($imageSelect.length > 0) {
			$imageSelect.each(function(){

				$(this).closest('.elementor-field').find('.image_picker_selector').remove();
				
				var gallery = $(this).data('pafe-form-builder-image-select'),
	                $options = $(this).find('option');

	            $(this).closest('.elementor-field').addClass('pafe-image-select-field');
	            var $imageSelectField = $(this);
	            
	            $options.each(function(index,element){
	            	if ($options.eq(0).attr('value').trim() == '' && index != 0) {
	            		var indexGallery = index - 1;
		                var imageURL = gallery[indexGallery]['url'],
		                    optionsContent = $(this).html();

		                $(this).attr('data-img-src',imageURL);
		                $imageSelectField.imagepicker({show_label: true});
		            }

		            if ($options.eq(0).attr('value').trim() != '') {
		                var imageURL = gallery[index]['url'],
		                    optionsContent = $(this).html();

		                $(this).attr('data-img-src',imageURL);
		                $imageSelectField.imagepicker({show_label: true});
		            }
	            });

			});
		}

		var $niceNumber = $repeaterNew.find('[data-pafe-form-builder-spiner] .nice-number');
		if ($niceNumber.length > 0) {
			$niceNumber.each(function(){
				var $field = $(this).closest('[data-pafe-form-builder-spiner]'),
					$input = $(this).find('.elementor-field'),
					inputHTML = $input.prop('outerHTML');
				$(this).after(inputHTML);
				$(this).remove();
				$field.find('.elementor-field').niceNumber({
					autoSize: false,
				});
			});
		}

		var $repeaterSub = $repeaterNew.find('[data-pafe-form-builder-repeater-id]');
		if ($repeaterSub.length > 0) {
			$repeaterSub.each(function(){
				var repeaterID = $(this).data('pafe-form-builder-repeater-id');
				$(this).siblings('[data-pafe-form-builder-repeater-id="'+ repeaterID +'"]').remove();
			});
		}

		$repeaterNew.find('[data-mask]').each(function(){
			$(this).mask($(this).attr('data-mask')); 
		}); 

		var $fieldsInside = $repeaterNew.find('[data-pafe-form-builder-form-id]');

		$fieldsInside.each(function(){
			var checkSelect = $(this).find('option:first');

			var checkRadioCheckbox = false;

			if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
				checkRadioCheckbox = true;
			}

			var defaultValue = $(this).data('pafe-form-builder-default-value');

			if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
        		$(this).val(defaultValue).change();
        	} else {
        		if (checkSelect.length != 0) {
    				$(this).val((checkSelect.val())).change();
    			} else {
					if (checkRadioCheckbox) {
    					$(this).prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
    				} else {
    					$(this).val('');
    				}
    			}
        	}
		});

		var $selectAutocomplete = $repeaterNew.find('[data-pafe-form-builder-select-autocomplete]');
		if ($selectAutocomplete.length > 0) {
			$selectAutocomplete.each(function(){
				var options = JSON.parse($(this).attr('data-options'));
				var optionsHTML = '';
				//console.log(options);

				for (var optionsIndex = 0; optionsIndex < options.length; optionsIndex++) {
					var option = options[optionsIndex];
					if (option.indexOf('|') >= 0) {
						option = option.split('|');
						optionsHTML += '<option value="' + option[0] + '">' + option[1] + '</option>';
					} else {
						optionsHTML += '<option value="' + option + '">' + option + '</option>';
					}
				}

				$(this).html(optionsHTML);
				$(this).closest('.elementor-field').find('.selectize-control').remove();

				$(this).selectize({
					dropdownParent: 'body',
				});
			}); 
		}

		var $dateField = $repeaterNew.find('.elementor-date-field');
		if ($dateField.length > 0) {
			var addDatePicker = function addDatePicker($element) {
				if ($element.hasClass('elementor-use-native')) { 
					return;
				}

				var minDate = $($element).attr('min') ? flatpickr.parseDate($($element).attr('min'), "Y-m-d") : null,
					maxDate = $($element).attr('max') ? flatpickr.parseDate($($element).attr('max'), "Y-m-d") : null;

				var options = {
					minDate: minDate,
					maxDate: maxDate,
					dateFormat: $element.attr('data-date-format') || null,
					defaultDate: $element.attr('data-pafe-form-builder-value') || null,
					allowInput: true
				};
				$element.flatpickr(options);
			};

			$dateField.each(function(){
				addDatePicker($(this));
			});
		}

		var $timeField = $repeaterNew.find('.elementor-time-field');
		if ($timeField.length > 0) {
			var addTimePicker = function addTimePicker($element) {
				if ($element.hasClass('elementor-use-native')) { 
					return;
				}
				$element.flatpickr({
					noCalendar: true,
					enableTime: true,
					allowInput: true,
					defaultDate: $element.attr('data-pafe-form-builder-value') || null,
				});
			};

			$timeField.each(function(){
				addTimePicker($(this));
			});
		}
	}

	$('[data-pafe-form-builder-repeater-form-id] [data-pafe-form-builder-repeater-trigger-action="remove"]').hide();

   function pafeRepeaterFillValue() {
		$('[data-pafe-form-builder-repeater-value]').each(function(){
	    	var repeaterJson = JSON.parse($(this).html().trim()),
	    		formID = $(this).data('pafe-form-builder-repeater-value-form-id'),
				repeaterID = $(this).data('pafe-form-builder-repeater-value-id'),
				$repeater = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + repeaterID + '"]');

			if ( repeaterJson.length >= 2 ) {
				$('[data-pafe-form-builder-repeater-form-id] [data-pafe-form-builder-repeater-trigger-action="remove"]').show();
			}

			if ($repeater.length > 0) {
				if ($(this).closest('[data-pafe-form-builder-repeater-form-id]').length > 0) {
					$repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]').find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + repeaterID + '"]');
				} 
	 
				for (var j = 0; j < (repeaterJson.length - 1); j++) {
					$repeater.eq(0).after($repeater.eq(0).prop('outerHTML'));
				}

				$repeater = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + repeaterID + '"]');

				$repeater.each(function(index,element){
					if (index != 0) {
						reInitFieldRepeater($(this));
					}
				});

				// Set value for Repeater

				$repeater = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + repeaterID + '"]');

				for(var k in repeaterJson) {
				    var repeaterItem = repeaterJson[k];
				    for(var key in repeaterItem) {
					    if (typeof repeaterItem[key] !== 'object') {
					    	var $fieldCurrent = $repeater.eq(k).find('[name^="form_fields[' + key + ']"]');
					    	setFieldValue($fieldCurrent,repeaterItem[key]);
					    } else {
					    	var $repeaterSub = $repeater.eq(k).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + key + '"]');
					    	for (var j = 0; j < (repeaterItem[key].length - 1); j++) {
								$repeaterSub.eq(0).after($repeaterSub.eq(0).prop('outerHTML'));
							}
					    	$repeaterSub = $repeater.eq(k).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"]'+'[data-pafe-form-builder-repeater-id="' + key + '"]');

							$repeaterSub.each(function(index,element){
								if (index != 0) {
									reInitFieldRepeater($(this));
								}
							});

							var repeaterItemSub = repeaterItem[key];
				    		for(var keySub in repeaterItemSub) {
				    			for(var keySubSecond in repeaterItemSub[keySub]) {
								    if (typeof repeaterItemSub[keySub][keySubSecond] !== 'object') {
								    	var $fieldCurrent = $repeaterSub.eq(keySub).find('[name^="form_fields[' + keySubSecond + ']"]');
								    	setFieldValue($fieldCurrent,repeaterItemSub[keySub][keySubSecond]);
								    }
							    }
						    }
					    }

					}
				}

				var $conditionals = $repeater.find('[data-pafe-form-builder-conditional-logic]');
				if ($conditionals.length > 0) {
					pafeConditionalLogicFormCheck($conditionals);
				}
				pafeCalculatedFieldsForm('');

				$(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-conditional-logic][data-pafe-form-builder-form-id="'+ formID +'"]').change();

			}
		});
	}

	setTimeout(pafeRepeaterFillValue(), 1000);

	setTimeout(pafePreviewSubmission(), 1000);
	
	$(document).on('keyup change','[data-pafe-form-builder-form-id]', $.debounce( 250, function(){
		pafePreviewSubmission();
	})
	);

	function pafePreviewSubmission() {
		var $previewSubmission = $(document).find('[data-pafe-form-builder-preview-submission]');

		if ($previewSubmission.length > 0) {
			$previewSubmission.each(function(){
		    	var formID = $(this).attr('data-pafe-form-builder-preview-submission'),
		    		$fields = $(document).find('[data-pafe-form-builder-form-id='+ formID +']'),
		    		fieldsOj = [],
		    		formData = new FormData();

				var $submit = $(this);
				var $parent = $submit.closest('.elementor-element');

				$fields.each(function(){
					if ( $(this).data('pafe-form-builder-stripe') == undefined && $(this).data('pafe-form-builder-html') == undefined ) {
						var $checkboxRequired = $(this).closest('.elementor-field-type-checkbox.elementor-field-required');
						var checked = 0;
						if ($checkboxRequired.length > 0) {
							checked = $checkboxRequired.find("input[type=checkbox]:checked").length;
						} 

						$(this).closest('.elementor-field-group').find('[data-pafe-form-builder-required]').html('');

						var fieldType = $(this).attr('type'),
							fieldName = $(this).attr('name');

						var $repeater = $(this).closest('[data-pafe-form-builder-repeater-form-id]'),
							repeaterID = '',
							repeaterIDOne = '',
							repeaterLabel = '',
							repeaterIndex = -1,
							repeaterLength = 0;

						if ($repeater.length > 0) {
							$repeaterParents = $(this).parents('[data-pafe-form-builder-repeater-form-id]');
							repeaterIDOne = $repeater.data('pafe-form-builder-repeater-id');
							$repeaterParents.each(function(){
								var repeaterParentID = $(this).data('pafe-form-builder-repeater-id'),
									$repeaterParentAll = $(document).find('[data-pafe-form-builder-repeater-form-id="' + formID + '"][data-pafe-form-builder-repeater-id="' + repeaterParentID + '"]');

								repeaterParentIndex = $(this).index() - $repeaterParentAll.index();
								repeaterID += repeaterParentID + '|index' + repeaterParentIndex + '|' + fieldName.replace('[]','').replace('form_fields[','').replace(']','') + ',';
							});

							repeaterLabel = $repeater.data('pafe-form-builder-repeater-label');

							var $repeaterAll = $(document).find('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]');
							repeaterLength = $repeater.siblings('[data-pafe-form-builder-repeater-id="' + $repeater.data('pafe-form-builder-repeater-id') + '"]').length + 1; 

							repeaterIndex = $repeater.index() - $repeaterAll.index();
						}

						if (fieldName.indexOf('[]') !== -1) {
		                    var fieldValueMultiple = [];

		                    if (fieldType == 'checkbox') {
		                        $(this).closest('.elementor-element').find('[name="'+ fieldName + '"]:checked').each(function () {
		                            fieldValueMultiple.push($(this).val());
		                        }); 
		                    } else {
		                        fieldValueMultiple = $(this).val();
		                        if (fieldValueMultiple == null) {
		                            var fieldValueMultiple = [];
		                        }
		                    }

		                    fieldValue = '';
		                    var fieldValueByLabel = '';

		                    for (var j = 0; j < fieldValueMultiple.length; j++) {
		                    	if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
		                    		var fieldValueSelected = fieldValueMultiple[j];

		                    		if (fieldType == 'checkbox') {
			                    		var $optionSelected = $(this).closest('.elementor-element').find('[value="' + fieldValueSelected + '"]');
			                			if ($optionSelected.length > 0) {
			                				fieldValueByLabel += $optionSelected.data('pafe-form-builder-send-data-by-label') + ',';
			                			}
		                			} else {
		                				var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
			                			if ($optionSelected.length > 0) {
			                				fieldValueByLabel += $optionSelected.html() + ',';
			                			}
		                			}
		                		}

		                		fieldValue += fieldValueMultiple[j] + ',';
		                    }

		                    fieldValue = fieldValue.replace(/,(\s+)?$/, '');
						} else {
							if (fieldType == 'radio' || fieldType == 'checkbox') {
								if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
									var fieldValueByLabel = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').data('pafe-form-builder-send-data-by-label');
								}

								var fieldValue = $(this).closest('.elementor-element').find('[name="'+ fieldName +'"]:checked').val();
			                } else {
			                	if ($(this).data('pafe-form-builder-calculated-fields') != undefined) {
			                		var fieldValue = $(this).siblings('.pafe-calculated-fields-form').text();
			                	} else {
			                		if ($(this).data('pafe-form-builder-send-data-by-label') != undefined) {
			                			var fieldValueSelected = $(this).val().trim();
			                			var $optionSelected = $(this).find('[value="' + fieldValueSelected + '"]');
			                			if ($optionSelected.length > 0) {
			                				fieldValueByLabel = $optionSelected.html();
			                			}
			                		}

			                		var fieldValue = $(this).val().trim();
			                	}
			                }
						}
						
						if (fieldValue != undefined) {
							var fieldItem = {};
							fieldItem['label'] = $(this).closest('.elementor-field-group').find('.elementor-field-label').html();
							fieldItem['name'] = fieldName.replace('[]','').replace('form_fields[','').replace(']','');
							fieldItem['value'] = fieldValue;
							if (fieldValueMultiple != undefined) {
								fieldItem['value_multiple'] = fieldValueMultiple;
							}
							fieldItem['type'] = $(this).attr('type');

							if ($(this).attr('data-pafe-form-builder-address-autocomplete') !== undefined) {
								fieldItem['lat'] = $(this).attr('data-pafe-form-builder-google-maps-lat');
								fieldItem['lng'] = $(this).attr('data-pafe-form-builder-google-maps-lng');
								fieldItem['zoom'] = $(this).attr('data-pafe-form-builder-google-maps-zoom');
							}
										
							if (fieldValueByLabel != '') { 
								fieldItem['value_label'] = fieldValueByLabel;
							}
							
							if ($(this).closest('.elementor-field-type-calculated_fields').length > 0) {
								fieldItem['calculation_results'] = $(this).val().trim();
							}
							
							if ($(this).closest('.pafe-form-builder-conditional-logic-hidden').length == 0) {
								fieldItem['repeater_id'] = repeaterID;
								fieldItem['repeater_id_one'] = repeaterIDOne;
								fieldItem['repeater_label'] = repeaterLabel;
								fieldItem['repeater_index'] = repeaterIndex; 
								fieldItem['repeater_length'] = repeaterLength;

								if ($(this).data('pafe-form-builder-remove-this-field-from-repeater') != undefined) {
		                    		fieldItem['repeater_remove_this_field'] = '1';
	                    		}

							    fieldsOj.push(fieldItem); 
							}
						}						
					}
				});

				formData.append("action", "pafe_ajax_form_builder_preview_submission");
				formData.append("fields", JSON.stringify(fieldsOj)); 

				if ($submit.attr('data-pafe-form-builder-preview-submission-remove-empty-fields') != undefined) {
					formData.append("remove_empty_fields", "");
				}

				if ($submit.attr('data-pafe-form-builder-preview-submission-custom-list-fields') != undefined) {
					formData.append("custom_list_fields", $submit.attr('data-pafe-form-builder-preview-submission-custom-list-fields') );
				}

				$.ajax({
					url: $('[data-pafe-ajax-url]').data('pafe-ajax-url'),
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						$submit.html(response);
					}
				});
			});
		}
		
	}

	function bookingLoad($this) {
		var date = $this.val(),
			formID = $this.attr('data-pafe-form-builder-form-id'),
			$bookingItem = $(document).find('[data-pafe-form-booking-item][data-pafe-form-builder-form-id="' + formID + '"]');

		if ($bookingItem.length > 0) {
			$bookingItem = $bookingItem.eq(0);
			var $bookingForm = $bookingItem.closest('[data-pafe-form-booking]');
			$bookingForm.addClass('pafe-form-booking--loading');

			var bookingOptions = JSON.parse( $bookingItem.attr('data-pafe-form-booking-item-options') );

			if ($bookingItem.closest('[data-pafe-form-builder-step-item-id]').length > 0) {
				var post_id = $bookingItem.closest('[data-pafe-form-builder-step-item-id]').attr('data-pafe-form-builder-step-item-id');
			} else {
				if ($bookingItem.closest('[data-elementor-id]').length > 0) {
					var post_id = $bookingItem.closest('[data-elementor-id]').attr('data-elementor-id');
				} else {
					var post_id = bookingOptions.pafe_form_booking_post_id;
				}
			}

			var data = {
				'action': 'pafe_form_booking',
				'date': date,
				'post_id': post_id,
				'element_id': bookingOptions.pafe_form_booking_element_id,
				'form_booking': $bookingForm.attr('data-pafe-form-booking'),
			};

	        $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data, function(response) {
	        	$bookingForm.html(response);
	        	pafeCalculatedFieldsForm('');

	        	$bookingForm.removeClass('pafe-form-booking--loading');
			});
		}
	}

	function bookingItemLoad() {
		$(document).find('[data-pafe-form-booking]').each(function(){
			var $bookingItems = $(this).find('[data-pafe-form-booking-item]');
			var $bookingItem = $bookingItems.eq(0);
			var options = JSON.parse( $bookingItem.attr('data-pafe-form-booking-item-options') );
			var bookingFormOptions = JSON.parse( $(this).attr('data-pafe-form-booking') );
			var booking_form_id = bookingFormOptions['pafe_form_booking_form_id'];
			var $bookingForm = $bookingItem.closest('[data-pafe-form-booking]');

			if(typeof options['pafe_form_booking_date_field'] !== 'undefined') {
			    var dateFieldID = '#form-field-' + options['pafe_form_booking_date_field'].replace('[field id=\"', '').replace('\"]', '');
			    var $dateField = $(document).find(dateFieldID + '[data-pafe-form-builder-form-id="' + booking_form_id + '"]');
				$dateField.addClass('pafe-form-booking-date');
			    bookingLoad($dateField);
			} else {
				var date = options['pafe_form_booking_date'],
					formID = $bookingItem.attr('data-pafe-form-builder-form-id'); 
					
				var bookingOptions = options;

				if ($bookingItem.closest('[data-pafe-form-builder-step-item-id]').length > 0) {
					var post_id = $bookingItem.closest('[data-pafe-form-builder-step-item-id]').attr('data-pafe-form-builder-step-item-id');
				} else {
					if ($bookingItem.closest('[data-elementor-id]').length > 0) {
						var post_id = $bookingItem.closest('[data-elementor-id]').attr('data-elementor-id');
					} else {
						var post_id = bookingOptions.pafe_form_booking_post_id;
					}
				}

				var data = {
					'action': 'pafe_form_booking',
					'date': date,
					'post_id': post_id,
					'element_id': bookingOptions.pafe_form_booking_element_id,
					'form_booking': $bookingForm.attr('data-pafe-form-booking'),
				};

		        $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data, function(response) {
		        	$bookingForm.html(response);
		        	pafeCalculatedFieldsForm('');

		        	$bookingForm.removeClass('pafe-form-booking--loading');
				});
			}
		});
	}
	
	bookingItemLoad();

	$(document).on( 'elementor/popup/show', function(event, id, instance){
		bookingItemLoad();
	} );  

	$(document).on('change','.pafe-form-booking-date',function(){
		bookingLoad($(this));
	});

	$(document).on('change','[data-pafe-form-booking-item]',function(){
		if ($(this).is(":checked")) {
			$(this).closest('.pafe-form-booking__item').addClass('active');

			if ($(this).attr('data-pafe-form-booking-item-radio') != undefined) {
				var $bookingItemOther = $(this).closest('.pafe-form-booking__item').siblings();
				$bookingItemOther.find('input').prop("checked", false);
				$bookingItemOther.removeClass('active');

				var options = JSON.parse( $(this).attr('data-pafe-form-booking-item-options') ); 

				if(typeof options['pafe_form_booking_slot_quantity_field'] !== 'undefined') {
					var quantityFieldID = '#form-field-' + options['pafe_form_booking_slot_quantity_field'].replace('[field id=\"', '').replace('\"]', '');
					var quantityMax = $(this).attr('data-pafe-form-builder-form-booking-availble');
			    	$(quantityFieldID).attr('max', quantityMax);
		    	}
			}
		} else {
			$(this).closest('.pafe-form-booking__item').removeClass('active');
		}
	});

	$(document).on('click','[data-pafe-form-builder-trigger-success],[data-pafe-form-builder-trigger-failed]',function(){
		bookingItemLoad();
	});

	function delayForNumberFieldtype(callback,ms) {
		var timer = 0;
		return function() {
			var context = this;
			clearTimeout(timer);
			timer = setTimeout(function () {
				callback.apply(context);
			}, ms);
		};
	}

	$(document).on('change keyup paste', '[type="number"][data-pafe-form-builder-form-id]',delayForNumberFieldtype(function (e) {
		var val = $(this).val();
		var min = $(this).attr('min');
		var max = $(this).attr('max');
		var isChanged = false;
		if(parseInt(min) > parseInt(val)){
			isChanged = true;
			$(this).val(min);
		}else if(parseInt(val) > parseInt(max)){
			isChanged = true;
			$(this).val(max);
		}
		if (isChanged) {
			$(this).change();
		}
	}, 500));

	$('[type="number"][data-pafe-form-builder-form-id]').bind('paste', function(e){
		var self = this;
		var min = $(this).attr('min');
		var max = $(this).attr('max');
		setTimeout(function(e) {
			var isChanged = false;
			var val2 = $(self).val();
			if(parseInt(min) > parseInt(val2)){
				isChanged = true;
				$(self).val(min);
			}else if(parseInt(val2) > parseInt(max)){
				isChanged = true;
				$(self).val(max);
			}
			if (isChanged) {
				$(this).change();
			}
		}, 0);
	});

	$(document).on('click','[data-pafe-form-builder-trigger-success]',function(){
		if ($(this).closest('.elementor-element').find('[data-pafe-form-builder-submit-update-user-profile]').length == 0) {
			var formId = $(this).attr('data-pafe-form-builder-trigger-success'),
				$fields = $(document).find('[data-pafe-form-builder-form-id="' + formId + '"]');

			$fields.each(function(){
				var checkSelect = $(this).find('option:first');

				var checkRadioCheckbox = false;

				if ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox') {
					checkRadioCheckbox = true;
				}

				var defaultValue = $(this).data('pafe-form-builder-default-value');

				if (defaultValue != undefined && defaultValue != '' || Number.isInteger(defaultValue) ) {
	        		if (checkRadioCheckbox) {
	        			$(this).prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
	        			if (defaultValue == $(this).val()) {
							$(this).prop('checked', true);
						}
					} else {
						$(this).val(defaultValue);
					}
	        	} else {
	        		if (checkSelect.length != 0) {
	    				$(this).val((checkSelect.val()));
	    			} else {
						if (checkRadioCheckbox) {
	    					$(this).prop('checked', false).removeClass('pafe-checked').removeClass('pafe-checked-setvalue');
	    				} else {
	    					$(this).val('');
	    				}
	    			}
	        	}
			});

			var $conditionals = $(document).find('body:not(.elementor-editor-active) [data-pafe-form-builder-conditional-logic]');
			if ($conditionals.length > 0) {
				pafeConditionalLogicFormCheck($conditionals);
			}
		}
        
        if ($('[data-pafe-submit-hide="true"]').length !== 0 ) {
            $('.pafe-form-builder-button').hide();
        }
	});

    $(document).on( 'elementor/popup/show', function(event, id, instance){
		$(document).find('.dialog-widget [data-mask]').each(function(){
			$(this).mask($(this).attr('data-mask')); 
		});  
	} ); 

    function paymentMethodsSelectField() {
		$('[data-pafe-form-builder-payment-methods-select-field]').each(function(){
			var fieldType = $(this).attr('type'),
				formID = $(this).attr('data-pafe-form-builder-form-id'),
				$submit = $(document).find('[data-pafe-form-builder-submit-form-id="' + formID + '"]');

			if (fieldType == 'radio' || fieldType == 'checkbox') {
				var fieldValue = $(this).closest('.elementor-element').find('input:checked').val();
	        } else {
	        	var fieldValue = $(this).val().trim();
	        }

	        if (fieldValue != $(this).attr('data-pafe-form-builder-payment-methods-select-field-value-for-stripe')) {
	        	if ($submit.attr('data-pafe-form-builder-stripe-currency') !== undefined) {
	        		$submit.removeAttr('data-pafe-form-builder-stripe-submit');
	        	}
	        } else {
	        	if ($submit.attr('data-pafe-form-builder-stripe-currency') !== undefined) {
	        		$submit.attr('data-pafe-form-builder-stripe-submit', '');
	        	}
	        }

	        if (fieldValue != $(this).attr('data-pafe-form-builder-payment-methods-select-field-value-for-paypal')) {
	        	if ($submit.attr('data-pafe-form-builder-paypal-submit-enable') !== undefined) {
	        		$submit.removeAttr('data-pafe-form-builder-paypal-submit');
	        		$submit.closest('.elementor-element').find('.pafe-form-builder-paypal').hide();
	        	}
	        } else {
	        	if ($submit.attr('data-pafe-form-builder-paypal-submit-enable') !== undefined) {
	        		$submit.attr('data-pafe-form-builder-paypal-submit', '');
	        		$submit.closest('.elementor-element').find('.pafe-form-builder-paypal').show();
	        	}
	        }
		});
	}  

	paymentMethodsSelectField();

	$(document).on('change','[data-pafe-form-builder-payment-methods-select-field]', function(){
		paymentMethodsSelectField();
	});

	$('[data-pafe-form-builder-submit-update-user-profile]').each(function(){
		var formID = $(this).attr('data-pafe-form-builder-submit-form-id'),
			userMeta = JSON.parse( $(this).attr('data-pafe-form-builder-submit-update-user-profile') );

		for (var i=0; i < userMeta.length; i++) {
			var $field = $(document).find('[data-pafe-form-builder-form-id="' + formID + '"][name^="form_fields[' + userMeta[i]['field_id'] + ']"]');
			setFieldValue($field, userMeta[i]['user_meta_value']);
		}
	});

	setTimeout(pafeLivePreview(), 1000);

	$(document).on('keyup change','[data-pafe-form-builder-form-id]', $.debounce( 100, function(){
			pafeLivePreview($(this)); 
		})
	);
	//Show password
	$(document).on('click', '[data-pafe-show_password-icon="true"]', function(){
		var password_show_name = $(this).attr('data-pafe-password-name');
		var current_type = $(this).closest('.pafe-field-container').find('[name="form_fields['+password_show_name+']"]').attr('type');
		var show_password_icon = $(this).closest('.pafe-field-container').find('#eyeIcon-'+password_show_name+'');
		if(current_type === 'password'){
			$(this).closest('.pafe-field-container').find('[name="form_fields['+password_show_name+']"]').attr('type', 'text');
			show_password_icon.addClass("fa-eye-slash");
		}else{
			$(this).closest('.pafe-field-container').find('[name="form_fields['+password_show_name+']"]').attr('type', 'password');
			show_password_icon.removeClass("fa-eye-slash");
		}
	});
	//Enter Submit Form
	const submitKeyboard = $('[data-pafe-submit-keyboard="true"]');
	$.each(submitKeyboard, function(index, item){
		let that = this;
		let submitID = $(this).attr('data-pafe-form-builder-submit-form-id');
		$('[data-pafe-form-builder-form-id="'+submitID+'"]').on('keyup', function(e){
			if(e.keyCode === 13){
				$(that).trigger('click');
			}
		});
	});
	function pafe_nl2br (str, is_xhtml) {
		if (typeof str === 'undefined' || str === null) {
			return '';
		}
		var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}
	function pafeLivePreview(field) {
		if ($(document).find('[data-pafe-form-builder-live-preview]').length > 0) {
			let section = $(field).closest('section').attr('data-pafe-form-builder-repeater-form-id');
			var $livePreview;
			var fieldValue = $(field).val(),
                fieldType = $(field).attr('type'),
				fieldId = $(field).attr('id');
				fieldType = fieldType ? fieldType : $(field).attr('data-pafe-field-type');
			if (fieldId !== undefined) {
                var allVals = [];
                var fieldName = $(field).attr('name').replace('[]','').replace('form_fields[','').replace(']','');
                if (fieldType == 'checkbox') {
                   $.each($('input[name="'+ $(field).attr('name') +'"]:checked'), function() {
					   	let checkboxValue = $(field).hasClass('pafe-preview-label') ? $(this).closest('.elementor-field-option').find('label').text() : $(this).val();
                    	allVals.push(checkboxValue);
                   });
                   fieldValue = allVals.join(", ");

                }
				if(fieldType == 'radio'){
					fieldValue = $(field).hasClass('pafe-preview-label') ? $(field).closest('.elementor-field-option').find('label').text() : $(field).val();
				}
				if(fieldType == 'select'){
					fieldValue = $(field).hasClass('pafe-preview-label') ? $(field).find('[value="'+fieldValue+'"]').text() : fieldValue;
				}
				if(section){
					$livePreview = $(field).closest('section').find('[data-pafe-form-builder-live-preview="' + fieldName + '"]');
				}else{
					fieldValue = pafe_nl2br($(field).val());
					$livePreview = $(document).find('[data-pafe-form-builder-live-preview="' + fieldName + '"]');
				}
				$livePreview.each(function(){
					if($(this).hasClass('pafe-live-preivew-image')){
						fieldValue = $(field).val();
						let width = $(this).data('image-width');
						let height = $(this).data('image-height');
						let images = $(field).val() ? $(field).val().split(',') : [];
						let html = '';
						if(images){
							$.each(images, function(index, item){
								html +=  '<img width="'+width+'" height="'+height+'" src="'+item+'"/>';
							});
						}
						$(this).html(html);
					}else{
						$(this).html(fieldValue);
					}
				});
			}
		}
	}

	$(document).on('change', '.elementor-field-option input[type="checkbox"]', function(evt) {
		var $parent = $(this).closest('.elementor-field-group'),
			$input = $parent.find('.elementor-field-option input[type="checkbox"]'),
			limit = $(this).data('pafe-checkbox-limit-multiple');

		if($input.filter(':checked').length > limit) {
			this.checked = false;
		}
	});

	$('.pafe-select-type-select2').each(function(){
		$(this).select2({
			tags: true
		});
	});

});

function clearValidity($this){
    var $parent = jQuery($this).closest('.elementor-field-subgroup');
    $firstOption = $parent.find('.elementor-field-option input');
    $firstOption.each(function(){
    	jQuery(this)[0].setCustomValidity('');
    }); 
    
}
