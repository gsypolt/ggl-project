if(null==menuPositionY)var menuPositionY=10;if(null==menuPositionIsLeft)var menuPositionIsLeft=!0;if(null==showMenuIcons)var showMenuIcons=!0;jQuery("body").append('<div id="menu-trigger" style="display:none"><div class="hamburger hamburger--spin js-hamburger"><div class="hamburger-box"><div class="hamburger-inner"></div></div></div></div><div id="menu-overlay" class="menu-overlayclass" style="display:none"></div><div id="click-blocker" style="display: none;"></div>'),jQuery(".myfantasyleague_menu").before('<div class="myfantasyleague_menuMobile"></div>'),jQuery("head").append("<style>.myfantasyleague_menuMobile{display:none;position:fixed;z-index:99999;width:250px;overflow-y:scroll;-webkit-overflow-scrolling:touch;height:calc(100vh - 10px)}#menu-trigger{position:fixed;top:"+menuPositionY+'px;padding:5px;z-index:99999;cursor:pointer;font-size:36px;line-height:40px;height:48px;width:42px;text-align:center}.myfantasyleague_menuMobile #icon-wrapper-mobile{position:absolute;top:0;left:auto;right:5px;display:block;z-index:1}.myfantasyleague_menuMobile #skinSelectorContainer{margin:0;position:fixed;top:40px;}.myfantasyleague_menuMobile li.notification-icon-login,.myfantasyleague_menuMobile li.notification-icon-search,.myfantasyleague_menuMobile .toggle_module_search,.myfantasyleague_menuMobile .toggle_module_login{display:none!important}.myfantasyleague_menuMobile #icon-wrapper-mobile img{margin:0!important}.myfantasyleague_menuMobile li{list-style:none;cursor:pointer}.myfantasyleague_menuMobile li,.myfantasyleague_menuMobile ul{margin:0;padding:0}.myfantasyleague_menuMobile a{word-wrap:break-word;text-decoration:none;padding-right:10px;display:block;-webkit-transition: background-color 300ms linear;-ms-transition: background-color 300ms linear;transition: background-color 300ms linear;}#menu-overlay{height:100%;width:100%;position:fixed;left:0;top:0;background:rgba(0,0,0,.6);z-index:99998}.myfantasyleague_menuMobile > ul > li > a,.myfantasyleague_menuMobile > ul > li > a:active,.myfantasyleague_menuMobile > ul > li > a:visited,.myfantasyleague_menuMobile > ul > li > a:hover{text-indent:5px;font-size:20px;line-height:40px}.myfantasyleague_menuMobile > ul > li > ul > li > a,.myfantasyleague_menuMobile > ul > li > ul > li > a:active,.myfantasyleague_menuMobile > ul > li > ul > li > a:visited,.myfantasyleague_menuMobile > ul > li > ul > li > a:hover{font-size:16px;line-height:34px;padding-left:10px}.myfantasyleague_menuMobile > ul > li > ul > li > ul > li > a,.myfantasyleague_menuMobile > ul > li > ul > li > ul > li > a:active,.myfantasyleague_menuMobile > ul > li > ul > li > ul > li > a:visited,.myfantasyleague_menuMobile > ul > li > ul > li > ul > li > a:hover{padding-left:15px;font-size:14px;line-height:28px}.myfantasyleague_menuMobile > ul > li.has-sub > a{position:relative}.myfantasyleague_menuMobile > ul > li.has-sub > a:after{content:"\\f067";font-family:FontAwesome;right:7px;position:absolute;top:1px;font-size:24px}.myfantasyleague_menuMobile > ul > li.has-sub.arrow-down > a:after{content:"\\f068";font-family:FontAwesome;right:7px;position:absolute;top:1px;font-size:24px}.myfantasyleague_menuMobile > ul > li.has-sub > ul > li.has-sub > a{position:relative}.myfantasyleague_menuMobile > ul > li.has-sub > ul > li.has-sub > a:after{content:"\\f067";font-family:FontAwesome;right:9px;position:absolute;top:1px;font-size:16px}.myfantasyleague_menuMobile > ul > li.has-sub > ul > li.has-sub.sub-arrow-down > a:after{content:"\\f063";font-family:FontAwesome;right:8px;position:absolute;top:1px;font-size:16px}.myfantasyleague_menuMobile #icon-wrapper-mobile span{display:inline-block}.myfantasyleague_menuMobile #skinSelectorOptions span,.myfantasyleague_menuMobile #skinSelectorContainer input{vertial-align:top}.myfantasyleague_menuMobile .mfl-icon,.myfantasyleague_menuMobile span,.myfantasyleague_menuMobile input[type="checkbox"],.myfantasyleague_menuMobile label{display:none}.mobile-menu-open {position:fixed;overflow:hidden;height:100%;}#click-blocker{position:fixed;top:0;bottom:0;left:0;right:0;z-index:100000}@media only screen and (min-width: 48.1em){#menu-overlay{display:none!important}}.hamburger-inner,.hamburger-inner::before,.hamburger-inner::after{background:var(--accent,#B82601)}.hamburger.is-active .hamburger-inner,.hamburger.is-active .hamburger-inner::before,.hamburger.is-active .hamburger-inner::after{background:var(--accent,#B82601)}.hamburger{cursor:pointer;transition-property:opacity,filter;transition-duration:.15s;transition-timing-function:linear;font:inherit;color:inherit;text-transform:none;background-color:transparent;border:0;margin:0;overflow:visible}.hamburger:hover{opacity:.7}.hamburger.is-active:hover{opacity:.7}.hamburger-box{width:40px;height:24px}.hamburger-inner{top:0;bottom:0;left:0;right:0;margin:auto}.hamburger-inner,.hamburger-inner::before,.hamburger-inner::after{width:25px;height:4px;border-radius:0;position:absolute;transition-property:transform;transition-duration:.15s;transition-timing-function:ease}.hamburger-inner::before,.hamburger-inner::after{content:"";display:block}.hamburger-inner::before{top:-10px}.hamburger-inner::after{bottom:-10px}.hamburger--3dx .hamburger-box{perspective:80px}.hamburger--3dx .hamburger-inner{transition:transform .15s cubic-bezier(0.645,0.045,0.355,1),background-color 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dx .hamburger-inner::before,.hamburger--3dx .hamburger-inner::after{transition:transform 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dx.is-active .hamburger-inner{background-color:transparent!important;transform:rotateY(180deg)}.hamburger--3dx.is-active .hamburger-inner::before{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--3dx.is-active .hamburger-inner::after{transform:translate3d(0,-10px,0) rotate(-45deg)}.hamburger--3dx-r .hamburger-box{perspective:80px}.hamburger--3dx-r .hamburger-inner{transition:transform .15s cubic-bezier(0.645,0.045,0.355,1),background-color 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dx-r .hamburger-inner::before,.hamburger--3dx-r .hamburger-inner::after{transition:transform 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dx-r.is-active .hamburger-inner{background-color:transparent!important;transform:rotateY(-180deg)}.hamburger--3dx-r.is-active .hamburger-inner::before{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--3dx-r.is-active .hamburger-inner::after{transform:translate3d(0,-10px,0) rotate(-45deg)}.hamburger--3dy .hamburger-box{perspective:80px}.hamburger--3dy .hamburger-inner{transition:transform .15s cubic-bezier(0.645,0.045,0.355,1),background-color 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dy .hamburger-inner::before,.hamburger--3dy .hamburger-inner::after{transition:transform 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dy.is-active .hamburger-inner{background-color:transparent!important;transform:rotateX(-180deg)}.hamburger--3dy.is-active .hamburger-inner::before{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--3dy.is-active .hamburger-inner::after{transform:translate3d(0,-10px,0) rotate(-45deg)}.hamburger--3dy-r .hamburger-box{perspective:80px}.hamburger--3dy-r .hamburger-inner{transition:transform .15s cubic-bezier(0.645,0.045,0.355,1),background-color 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dy-r .hamburger-inner::before,.hamburger--3dy-r .hamburger-inner::after{transition:transform 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dy-r.is-active .hamburger-inner{background-color:transparent!important;transform:rotateX(180deg)}.hamburger--3dy-r.is-active .hamburger-inner::before{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--3dy-r.is-active .hamburger-inner::after{transform:translate3d(0,-10px,0) rotate(-45deg)}.hamburger--3dxy .hamburger-box{perspective:80px}.hamburger--3dxy .hamburger-inner{transition:transform .15s cubic-bezier(0.645,0.045,0.355,1),background-color 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dxy .hamburger-inner::before,.hamburger--3dxy .hamburger-inner::after{transition:transform 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dxy.is-active .hamburger-inner{background-color:transparent!important;transform:rotateX(180deg) rotateY(180deg)}.hamburger--3dxy.is-active .hamburger-inner::before{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--3dxy.is-active .hamburger-inner::after{transform:translate3d(0,-10px,0) rotate(-45deg)}.hamburger--3dxy-r .hamburger-box{perspective:80px}.hamburger--3dxy-r .hamburger-inner{transition:transform .15s cubic-bezier(0.645,0.045,0.355,1),background-color 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dxy-r .hamburger-inner::before,.hamburger--3dxy-r .hamburger-inner::after{transition:transform 0 .1s cubic-bezier(0.645,0.045,0.355,1)}.hamburger--3dxy-r.is-active .hamburger-inner{background-color:transparent!important;transform:rotateX(180deg) rotateY(180deg) rotateZ(-180deg)}.hamburger--3dxy-r.is-active .hamburger-inner::before{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--3dxy-r.is-active .hamburger-inner::after{transform:translate3d(0,-10px,0) rotate(-45deg)}.hamburger--arrow.is-active .hamburger-inner::before{transform:translate3d(-8px,0,0) rotate(-45deg) scale(0.7,1)}.hamburger--arrow.is-active .hamburger-inner::after{transform:translate3d(-8px,0,0) rotate(45deg) scale(0.7,1)}.hamburger--arrow-r.is-active .hamburger-inner::before{transform:translate3d(8px,0,0) rotate(45deg) scale(0.7,1)}.hamburger--arrow-r.is-active .hamburger-inner::after{transform:translate3d(8px,0,0) rotate(-45deg) scale(0.7,1)}.hamburger--arrowalt .hamburger-inner::before{transition:top .1s .1s ease,transform .1s cubic-bezier(0.165,0.84,0.44,1)}.hamburger--arrowalt .hamburger-inner::after{transition:bottom .1s .1s ease,transform .1s cubic-bezier(0.165,0.84,0.44,1)}.hamburger--arrowalt.is-active .hamburger-inner::before{top:0;transform:translate3d(-8px,-10px,0) rotate(-45deg) scale(0.7,1);transition:top .1s ease,transform .1s .1s cubic-bezier(0.895,0.03,0.685,0.22)}.hamburger--arrowalt.is-active .hamburger-inner::after{bottom:0;transform:translate3d(-8px,10px,0) rotate(45deg) scale(0.7,1);transition:bottom .1s ease,transform .1s .1s cubic-bezier(0.895,0.03,0.685,0.22)}.hamburger--arrowalt-r .hamburger-inner::before{transition:top .1s .1s ease,transform .1s cubic-bezier(0.165,0.84,0.44,1)}.hamburger--arrowalt-r .hamburger-inner::after{transition:bottom .1s .1s ease,transform .1s cubic-bezier(0.165,0.84,0.44,1)}.hamburger--arrowalt-r.is-active .hamburger-inner::before{top:0;transform:translate3d(8px,-10px,0) rotate(45deg) scale(0.7,1);transition:top .1s ease,transform .1s .1s cubic-bezier(0.895,0.03,0.685,0.22)}.hamburger--arrowalt-r.is-active .hamburger-inner::after{bottom:0;transform:translate3d(8px,10px,0) rotate(-45deg) scale(0.7,1);transition:bottom .1s ease,transform .1s .1s cubic-bezier(0.895,0.03,0.685,0.22)}.hamburger--arrowturn.is-active .hamburger-inner{transform:rotate(-180deg)}.hamburger--arrowturn.is-active .hamburger-inner::before{transform:translate3d(8px,0,0) rotate(45deg) scale(0.7,1)}.hamburger--arrowturn.is-active .hamburger-inner::after{transform:translate3d(8px,0,0) rotate(-45deg) scale(0.7,1)}.hamburger--arrowturn-r.is-active .hamburger-inner{transform:rotate(-180deg)}.hamburger--arrowturn-r.is-active .hamburger-inner::before{transform:translate3d(-8px,0,0) rotate(-45deg) scale(0.7,1)}.hamburger--arrowturn-r.is-active .hamburger-inner::after{transform:translate3d(-8px,0,0) rotate(45deg) scale(0.7,1)}.hamburger--boring .hamburger-inner,.hamburger--boring .hamburger-inner::before,.hamburger--boring .hamburger-inner::after{transition-property:none}.hamburger--boring.is-active .hamburger-inner{transform:rotate(45deg)}.hamburger--boring.is-active .hamburger-inner::before{top:0;opacity:0}.hamburger--boring.is-active .hamburger-inner::after{bottom:0;transform:rotate(-90deg)}.hamburger--collapse .hamburger-inner{top:auto;bottom:0;transition-duration:.13s;transition-delay:.13s;transition-timing-function:cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--collapse .hamburger-inner::after{top:-20px;transition:top .2s .2s cubic-bezier(0.33333,0.66667,0.66667,1),opacity .1s linear}.hamburger--collapse .hamburger-inner::before{transition:top .12s .2s cubic-bezier(0.33333,0.66667,0.66667,1),transform .13s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--collapse.is-active .hamburger-inner{transform:translate3d(0,-10px,0) rotate(-45deg);transition-delay:.22s;transition-timing-function:cubic-bezier(0.215,0.61,0.355,1)}.hamburger--collapse.is-active .hamburger-inner::after{top:0;opacity:0;transition:top .2s cubic-bezier(0.33333,0,0.66667,0.33333),opacity .1s .22s linear}.hamburger--collapse.is-active .hamburger-inner::before{top:0;transform:rotate(-90deg);transition:top .1s .16s cubic-bezier(0.33333,0,0.66667,0.33333),transform .13s .25s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--collapse-r .hamburger-inner{top:auto;bottom:0;transition-duration:.13s;transition-delay:.13s;transition-timing-function:cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--collapse-r .hamburger-inner::after{top:-20px;transition:top .2s .2s cubic-bezier(0.33333,0.66667,0.66667,1),opacity .1s linear}.hamburger--collapse-r .hamburger-inner::before{transition:top .12s .2s cubic-bezier(0.33333,0.66667,0.66667,1),transform .13s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--collapse-r.is-active .hamburger-inner{transform:translate3d(0,-10px,0) rotate(45deg);transition-delay:.22s;transition-timing-function:cubic-bezier(0.215,0.61,0.355,1)}.hamburger--collapse-r.is-active .hamburger-inner::after{top:0;opacity:0;transition:top .2s cubic-bezier(0.33333,0,0.66667,0.33333),opacity .1s .22s linear}.hamburger--collapse-r.is-active .hamburger-inner::before{top:0;transform:rotate(90deg);transition:top .1s .16s cubic-bezier(0.33333,0,0.66667,0.33333),transform .13s .25s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--elastic .hamburger-inner{top:2px;transition-duration:.275s;transition-timing-function:cubic-bezier(0.68,-0.55,0.265,1.55)}.hamburger--elastic .hamburger-inner::before{top:10px;transition:opacity .125s .275s ease}.hamburger--elastic .hamburger-inner::after{top:20px;transition:transform .275s cubic-bezier(0.68,-0.55,0.265,1.55)}.hamburger--elastic.is-active .hamburger-inner{transform:translate3d(0,10px,0) rotate(135deg);transition-delay:.075s}.hamburger--elastic.is-active .hamburger-inner::before{transition-delay:0;opacity:0}.hamburger--elastic.is-active .hamburger-inner::after{transform:translate3d(0,-20px,0) rotate(-270deg);transition-delay:.075s}.hamburger--elastic-r .hamburger-inner{top:2px;transition-duration:.275s;transition-timing-function:cubic-bezier(0.68,-0.55,0.265,1.55)}.hamburger--elastic-r .hamburger-inner::before{top:10px;transition:opacity .125s .275s ease}.hamburger--elastic-r .hamburger-inner::after{top:20px;transition:transform .275s cubic-bezier(0.68,-0.55,0.265,1.55)}.hamburger--elastic-r.is-active .hamburger-inner{transform:translate3d(0,10px,0) rotate(-135deg);transition-delay:.075s}.hamburger--elastic-r.is-active .hamburger-inner::before{transition-delay:0;opacity:0}.hamburger--elastic-r.is-active .hamburger-inner::after{transform:translate3d(0,-20px,0) rotate(270deg);transition-delay:.075s}.hamburger--emphatic{overflow:hidden}.hamburger--emphatic .hamburger-inner{transition:background-color .125s .175s ease-in}.hamburger--emphatic .hamburger-inner::before{left:0;transition:transform .125s cubic-bezier(0.6,0.04,0.98,0.335),top .05s .125s linear,left .125s .175s ease-in}.hamburger--emphatic .hamburger-inner::after{top:10px;right:0;transition:transform .125s cubic-bezier(0.6,0.04,0.98,0.335),top .05s .125s linear,right .125s .175s ease-in}.hamburger--emphatic.is-active .hamburger-inner{transition-delay:0;transition-timing-function:ease-out;background-color:transparent!important}.hamburger--emphatic.is-active .hamburger-inner::before{left:-80px;top:-80px;transform:translate3d(80px,80px,0) rotate(45deg);transition:left .125s ease-out,top .05s .125s linear,transform .125s .175s cubic-bezier(0.075,0.82,0.165,1)}.hamburger--emphatic.is-active .hamburger-inner::after{right:-80px;top:-80px;transform:translate3d(-80px,80px,0) rotate(-45deg);transition:right .125s ease-out,top .05s .125s linear,transform .125s .175s cubic-bezier(0.075,0.82,0.165,1)}.hamburger--emphatic-r{overflow:hidden}.hamburger--emphatic-r .hamburger-inner{transition:background-color .125s .175s ease-in}.hamburger--emphatic-r .hamburger-inner::before{left:0;transition:transform .125s cubic-bezier(0.6,0.04,0.98,0.335),top .05s .125s linear,left .125s .175s ease-in}.hamburger--emphatic-r .hamburger-inner::after{top:10px;right:0;transition:transform .125s cubic-bezier(0.6,0.04,0.98,0.335),top .05s .125s linear,right .125s .175s ease-in}.hamburger--emphatic-r.is-active .hamburger-inner{transition-delay:0;transition-timing-function:ease-out;background-color:transparent!important}.hamburger--emphatic-r.is-active .hamburger-inner::before{left:-80px;top:80px;transform:translate3d(80px,-80px,0) rotate(-45deg);transition:left .125s ease-out,top .05s .125s linear,transform .125s .175s cubic-bezier(0.075,0.82,0.165,1)}.hamburger--emphatic-r.is-active .hamburger-inner::after{right:-80px;top:80px;transform:translate3d(-80px,-80px,0) rotate(45deg);transition:right .125s ease-out,top .05s .125s linear,transform .125s .175s cubic-bezier(0.075,0.82,0.165,1)}.hamburger--minus .hamburger-inner::before,.hamburger--minus .hamburger-inner::after{transition:bottom .08s 0 ease-out,top .08s 0 ease-out,opacity 0 linear}.hamburger--minus.is-active .hamburger-inner::before,.hamburger--minus.is-active .hamburger-inner::after{opacity:0;transition:bottom .08s ease-out,top .08s ease-out,opacity 0 .08s linear}.hamburger--minus.is-active .hamburger-inner::before{top:0}.hamburger--minus.is-active .hamburger-inner::after{bottom:0}.hamburger--slider .hamburger-inner{top:2px}.hamburger--slider .hamburger-inner::before{top:10px;transition-property:transform,opacity;transition-timing-function:ease;transition-duration:.15s}.hamburger--slider .hamburger-inner::after{top:20px}.hamburger--slider.is-active .hamburger-inner{transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--slider.is-active .hamburger-inner::before{transform:rotate(-45deg) translate3d(-5.71429px,-6px,0);opacity:0}.hamburger--slider.is-active .hamburger-inner::after{transform:translate3d(0,-20px,0) rotate(-90deg)}.hamburger--slider-r .hamburger-inner{top:2px}.hamburger--slider-r .hamburger-inner::before{top:10px;transition-property:transform,opacity;transition-timing-function:ease;transition-duration:.15s}.hamburger--slider-r .hamburger-inner::after{top:20px}.hamburger--slider-r.is-active .hamburger-inner{transform:translate3d(0,10px,0) rotate(-45deg)}.hamburger--slider-r.is-active .hamburger-inner::before{transform:rotate(45deg) translate3d(5.71429px,-6px,0);opacity:0}.hamburger--slider-r.is-active .hamburger-inner::after{transform:translate3d(0,-20px,0) rotate(90deg)}.hamburger--spin .hamburger-inner{transition-duration:.22s;transition-timing-function:cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spin .hamburger-inner::before{transition:top .1s .25s ease-in,opacity .1s ease-in}.hamburger--spin .hamburger-inner::after{transition:bottom .1s .25s ease-in,transform .22s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spin.is-active .hamburger-inner{transform:rotate(225deg);transition-delay:.12s;transition-timing-function:cubic-bezier(0.215,0.61,0.355,1)}.hamburger--spin.is-active .hamburger-inner::before{top:0;opacity:0;transition:top .1s ease-out,opacity .1s .12s ease-out}.hamburger--spin.is-active .hamburger-inner::after{bottom:0;transform:rotate(-90deg);transition:bottom .1s ease-out,transform .22s .12s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--spin-r .hamburger-inner{transition-duration:.22s;transition-timing-function:cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spin-r .hamburger-inner::before{transition:top .1s .25s ease-in,opacity .1s ease-in}.hamburger--spin-r .hamburger-inner::after{transition:bottom .1s .25s ease-in,transform .22s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spin-r.is-active .hamburger-inner{transform:rotate(-225deg);transition-delay:.12s;transition-timing-function:cubic-bezier(0.215,0.61,0.355,1)}.hamburger--spin-r.is-active .hamburger-inner::before{top:0;opacity:0;transition:top .1s ease-out,opacity .1s .12s ease-out}.hamburger--spin-r.is-active .hamburger-inner::after{bottom:0;transform:rotate(90deg);transition:bottom .1s ease-out,transform .22s .12s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--spring .hamburger-inner{top:2px;transition:background-color 0 .13s linear}.hamburger--spring .hamburger-inner::before{top:10px;transition:top .1s .2s cubic-bezier(0.33333,0.66667,0.66667,1),transform .13s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spring .hamburger-inner::after{top:20px;transition:top .2s .2s cubic-bezier(0.33333,0.66667,0.66667,1),transform .13s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spring.is-active .hamburger-inner{transition-delay:.22s;background-color:transparent!important}.hamburger--spring.is-active .hamburger-inner::before{top:0;transition:top .1s .15s cubic-bezier(0.33333,0,0.66667,0.33333),transform .13s .22s cubic-bezier(0.215,0.61,0.355,1);transform:translate3d(0,10px,0) rotate(45deg)}.hamburger--spring.is-active .hamburger-inner::after{top:0;transition:top .2s cubic-bezier(0.33333,0,0.66667,0.33333),transform .13s .22s cubic-bezier(0.215,0.61,0.355,1);transform:translate3d(0,10px,0) rotate(-45deg)}.hamburger--spring-r .hamburger-inner{top:auto;bottom:0;transition-duration:.13s;transition-delay:0;transition-timing-function:cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spring-r .hamburger-inner::after{top:-20px;transition:top .2s .2s cubic-bezier(0.33333,0.66667,0.66667,1),opacity 0 linear}.hamburger--spring-r .hamburger-inner::before{transition:top .1s .2s cubic-bezier(0.33333,0.66667,0.66667,1),transform .13s cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--spring-r.is-active .hamburger-inner{transform:translate3d(0,-10px,0) rotate(-45deg);transition-delay:.22s;transition-timing-function:cubic-bezier(0.215,0.61,0.355,1)}.hamburger--spring-r.is-active .hamburger-inner::after{top:0;opacity:0;transition:top .2s cubic-bezier(0.33333,0,0.66667,0.33333),opacity 0 .22s linear}.hamburger--spring-r.is-active .hamburger-inner::before{top:0;transform:rotate(90deg);transition:top .1s .15s cubic-bezier(0.33333,0,0.66667,0.33333),transform .13s .22s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--stand .hamburger-inner{transition:transform .075s .15s cubic-bezier(0.55,0.055,0.675,0.19),background-color 0 .075s linear}.hamburger--stand .hamburger-inner::before{transition:top .075s .075s ease-in,transform .075s 0 cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--stand .hamburger-inner::after{transition:bottom .075s .075s ease-in,transform .075s 0 cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--stand.is-active .hamburger-inner{transform:rotate(90deg);background-color:transparent!important;transition:transform .075s 0 cubic-bezier(0.215,0.61,0.355,1),background-color 0 .15s linear}.hamburger--stand.is-active .hamburger-inner::before{top:0;transform:rotate(-45deg);transition:top .075s .1s ease-out,transform .075s .15s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--stand.is-active .hamburger-inner::after{bottom:0;transform:rotate(45deg);transition:bottom .075s .1s ease-out,transform .075s .15s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--stand-r .hamburger-inner{transition:transform .075s .15s cubic-bezier(0.55,0.055,0.675,0.19),background-color 0 .075s linear}.hamburger--stand-r .hamburger-inner::before{transition:top .075s .075s ease-in,transform .075s 0 cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--stand-r .hamburger-inner::after{transition:bottom .075s .075s ease-in,transform .075s 0 cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--stand-r.is-active .hamburger-inner{transform:rotate(-90deg);background-color:transparent!important;transition:transform .075s 0 cubic-bezier(0.215,0.61,0.355,1),background-color 0 .15s linear}.hamburger--stand-r.is-active .hamburger-inner::before{top:0;transform:rotate(-45deg);transition:top .075s .1s ease-out,transform .075s .15s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--stand-r.is-active .hamburger-inner::after{bottom:0;transform:rotate(45deg);transition:bottom .075s .1s ease-out,transform .075s .15s cubic-bezier(0.215,0.61,0.355,1)}.hamburger--squeeze .hamburger-inner{transition-duration:.075s;transition-timing-function:cubic-bezier(0.55,0.055,0.675,0.19)}.hamburger--squeeze .hamburger-inner::before{transition:top .075s .12s ease,opacity .075s ease}.hamburger--squeeze .hamburger-inner::after{transition:bottom .075s .12s ease,transform .075s cubic-bezier(0.55,0.055,0.675,0.19)}</style>'),jQuery(".myfantasyleague_menuMobile").html(jQuery(".myfantasyleague_menu").html()),jQuery(".myfantasyleague_menuMobile > ul").append('<li class="has-sub sub-default" id="slide-menu-login"><a>Login</a><ul></ul></li>'),jQuery(".myfantasyleague_menuMobile > ul").append('<li class="has-sub sub-default" style="visibility:hidden"><a>Blank</a><ul></ul></li><li class="has-sub sub-default" style="visibility:hidden"><a>Blank</a><ul></ul></li>'),jQuery(".myfantasyleague_menuMobile .has-sub.sub-default ul").hide(),jQuery('.myfantasyleague_menuMobile ul li:contains("Communications") a:contains("Chat")').replaceWith('<a href="'+baseURLDynamic+"/"+year+"/home/"+league_id+'?MODULE=LEAGUE_CHAT" onclick="openChatWindow(this); return false;" target="_blank">League Chat</a>'),jQuery('.myfantasyleague_menuMobile ul li:contains("This Page")').remove(),jQuery('.myfantasyleague_menuMobile ul li:contains("My Leagues") a:contains("$75,000")').parent().remove(),jQuery(".myfantasyleague_menuMobile > ul > li a.no-sub:eq(1)").parent().addClass("mm-home"),jQuery(".myfantasyleague_menuMobile > ul > li.has-sub.sub-default").each(function(){$(this).addClass("mm-"+$(this).find("a:eq(0)").text().toLowerCase().replace(/ /g,""))}),jQuery(document).ready(function(){var e=baseURLDynamic+"/"+year+"/home/"+league_id+"?MODULE=WELCOME";jQuery.ajax({url:e,success:function(e){jQuery(e).find("#welcome td a").each(function(){jQuery("#slide-menu-login ul").append('<li><a class="no-sub" href="'+jQuery(this).attr("href")+'">'+jQuery(this).text()+"</a></li>")})},async:!0})}),jQuery(".myfantasyleague_menuMobile > ul > li.has-sub.sub-default > a").each(function(e){$(this).on("click",function(){var e=$(".myfantasyleague_menuMobile > ul > li.has-sub.sub-default > ul"),r=$(".myfantasyleague_menuMobile > ul > li.has-sub.sub-default > ul > li > ul"),a=$(this).parent("li").children("ul");e.each(function(){$(this).slideUp()}),r.each(function(){$(this).slideUp()}),a.hasClass("thisExpanded")?a.slideUp().removeClass("thisExpanded"):a.slideDown().addClass("thisExpanded"),e.removeClass("lastClicked"),r.removeClass("lastClicked"),a.addClass("lastClicked"),e.each(function(){$(this).hasClass("lastClicked")||$(this).removeClass("thisExpanded")}),r.each(function(){$(this).removeClass("thisExpanded")}),$("ul").parent("li").removeClass("arrow-down"),$("ul.thisExpanded").parent("li").addClass("arrow-down"),$("li").removeClass("sub-arrow-down")})}),jQuery(".myfantasyleague_menuMobile > ul > li.has-sub.sub-default > ul > li > a").each(function(e){$(this).on("click",function(){var e=$(".myfantasyleague_menuMobile > ul > li.has-sub.sub-default > ul > li > ul"),r=$(this).parent("li").children("ul");e.each(function(){$(this).slideUp()}),r.hasClass("thisExpanded")?r.slideUp().removeClass("thisExpanded"):r.slideDown().addClass("thisExpanded"),e.removeClass("lastClicked"),r.addClass("lastClicked"),e.each(function(){$(this).hasClass("lastClicked")||$(this).removeClass("thisExpanded")}),$("ul").parent("li").removeClass("sub-arrow-down"),$("ul.thisExpanded").parent("li").addClass("sub-arrow-down")})}),menuPositionIsLeft?jQuery("head").append("<style>.myfantasyleague_menuMobile{border:0;border-right-width:2px;border-style:solid;left:0;margin-left:-250px}#menu-trigger{left:0;border-left:0;-webkit-border-top-right-radius:3px;-webkit-border-bottom-right-radius:3px;-moz-border-radius-topright:3px;-moz-border-radius-bottomright:3px;border-top-right-radius:3px;border-bottom-right-radius:3px}.myfantasyleague_menuMobile #skinSelectorContainer{left:15px}</style>"):jQuery("head").append("<style>.myfantasyleague_menuMobile{border:0;border-left-width:2px;border-style:solid;right:0;margin-right:-250px}#menu-trigger{right:0;border-right:0;-webkit-border-top-left-radius:3px;-webkit-border-bottom-left-radius:3px;-moz-border-radius-topleft:3px;-moz-border-radius-bottomleft:3px;border-top-left-radius:3px;border-bottom-left-radius:3px}.myfantasyleague_menuMobile #skinSelectorContainer{right:30px}</style>"),jQuery("#menu-trigger").on("click",function(){"250px"==$(this).css("margin-left")||"250px"==$(this).css("margin-right")?(menuPositionIsLeft?$(".myfantasyleague_menuMobile,#menu-trigger").animate({"margin-left":"-=250"}):$(".myfantasyleague_menuMobile,#menu-trigger").animate({"margin-right":"-=250"}),$("html,body").removeClass("mobile-menu-open")):(menuPositionIsLeft?$(".myfantasyleague_menuMobile,#menu-trigger").animate({"margin-left":"+=250"}):$(".myfantasyleague_menuMobile,#menu-trigger").animate({"margin-right":"+=250"}),$("html,body").addClass("mobile-menu-open")),$(".skinSelectorContainer").hide(),$("#menu-overlay").fadeToggle(),$(".myfantasyleague_menuMobile ul li").removeClass("arrow-down sub-arrow-down"),$(".myfantasyleague_menuMobile ul li.has-sub.sub-default ul").removeClass("thisExpanded").slideUp(),$(".hamburger").toggleClass("is-active")}),jQuery("#menu-overlay").on("click",function(){$("#click-blocker").show(),menuPositionIsLeft?$(".myfantasyleague_menuMobile,#menu-trigger").animate({"margin-left":"-=250"}):$(".myfantasyleague_menuMobile,#menu-trigger").animate({"margin-right":"-=250"}),$("#menu-overlay").fadeToggle(),$(".myfantasyleague_menuMobile ul li").removeClass("arrow-down sub-arrow-down"),$(".myfantasyleague_menuMobile ul li.has-sub.sub-default ul").removeClass("thisExpanded").slideUp(),$("html,body").removeClass("mobile-menu-open"),$(".skinSelectorContainer").hide(),setTimeout("$('#click-blocker').hide()",500),$(".hamburger").removeClass("is-active")}),showMenuIcons&&jQuery("head").append('<style>.myfantasyleague_menuMobile > ul > li > a:before{font-family:FontAwesome;width:22px;display:inline-block;text-indent:0;text-align:center;margin-right:10px}.myfantasyleague_menuMobile > ul > li.mm-home > a:before{content:"\\f015"}.myfantasyleague_menuMobile > ul > li.mm-myleagues > a:before{content:"\\f0cb"}.myfantasyleague_menuMobile > ul > li.mm-reports > a:before{content:"\\f080"}.myfantasyleague_menuMobile > ul > li.mm-forowners > a:before{content:"\\f0c0"}.myfantasyleague_menuMobile > ul > li.mm-forcommissioners > a:before{content:"\\f085"}.myfantasyleague_menuMobile > ul > li.mm-communications > a:before {content:"\\f0e6"}.myfantasyleague_menuMobile > ul > li.mm-links > a:before{content:"\\f0c1"}.myfantasyleague_menuMobile > ul > li.mm-help > a:before{content:"\\f29c"}.myfantasyleague_menuMobile > ul > li.mm-login > a:before{content:"\\f023"}</style>');