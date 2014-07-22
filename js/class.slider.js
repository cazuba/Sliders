/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    function CallSlider(){
        this.initialized=0;
        this.SLIDE=0;
        this.MAX_SLIDERS=0;
        this.pos_left = 0;
        this.timer=null;
        this.TIME_WAITING = 10;/* SEGUNDOS */
        this.id_slider="slider";
        this.class_slider="box";
        this.running=false;
        this.going_back=false;
        this.canslide=true;
        
        var _self=this;
        this.init = function(time_to_wait){
            setTimeout(function(){
                _self._init(time_to_wait);
            },500);
        };
        this._init = function (time_to_wait){
            time_to_wait = time_to_wait || 10;
            _self.pos_left = ($("."+_self.class_slider+":first-child").width()+($("#"+_self.id_slider+":first-child").width()-$("."+_self.class_slider).width()));
            _self.MAX_SLIDERS = $("."+_self.class_slider).length-1;
            if(_self.MAX_SLIDERS<=0) _self.canslide=false;/* CAN'T CLICK NEXT OR PREVIOUS*/
            _self.TIME_WAITING=time_to_wait;
            if( _self.initialized==0 ){
                $("#"+_self.id_slider+" > .pointers > span:first-child").addClass("fa-circle");
                _self.initialized=1;
                _self.start();
            }
        };
        this.animate_slider = function(){
            if(!_self.canslide) return false;
            if(_self.going_back==true){
                _self.SLIDE++;
                _self.going_back=false;
            }
            _self.SLIDE++;
            if(_self.SLIDE>_self.MAX_SLIDERS) _self.SLIDE=0;
            $("#"+_self.id_slider+" > .pointers > span").removeClass("fa-circle");
            $("#"+_self.id_slider+" > .pointers > span:nth("+_self.SLIDE+")").addClass("fa-circle");
            $("."+_self.class_slider).animate({left:(_self.pos_left*_self.SLIDE)*-1});
            
        };
        this.start = function (){
            if(!_self.canslide) return false;
            if(_self.running) return false;
            _self.running = true;
            _self.timer = setInterval(function(){
                _self.animate_slider();
            },_self.TIME_WAITING*1000);
        };
        this.stop = function (){
            if(!_self.running) return false;
            clearInterval(_self.timer);
            _self.running = false;
        };
        this.next = function (){
            if(!_self.canslide) return false;
            _self.stop();
            _self.animate_slider();
            _self.start();
        };
        this.previous = function (){
            if(!_self.canslide) return false;
            _self.stop();
            if( _self.SLIDE<=0 )
                _self.SLIDE = _self.MAX_SLIDERS;
            else{
                _self.SLIDE --;
            }
            if(_self.SLIDE<0) _self.SLIDE=_self.MAX_SLIDERS;
            
            _self.going_back=true;
            $("."+_self.class_slider).animate({left:(_self.pos_left*_self.SLIDE)*-1});
            $("#"+_self.id_slider+" > .pointers > span").removeClass("fa-circle");
            $("#"+_self.id_slider+" > .pointers > span:nth("+_self.SLIDE+")").addClass("fa-circle");
            _self.start();
        };
        this.setSlide = function (int_slide){
            if(!_self.canslide) return false;
            _self.stop();
            
            if(int_slide<0) int_slide=0;
            else if(int_slide>_self.MAX_SLIDERS) int_slide = _self.MAX_SLIDERS;
            _self.SLIDE=int_slide;
            
            $("."+_self.class_slider).animate({left:(_self.pos_left*_self.SLIDE)*-1});
            $("#"+_self.id_slider+" > .pointers > span").removeClass("fa-circle");
            $("#"+_self.id_slider+" > .pointers > span:nth("+_self.SLIDE+")").addClass("fa-circle");
            
            _self.start();
        };
    }