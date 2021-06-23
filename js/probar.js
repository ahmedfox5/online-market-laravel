var circle = {
    "circle_width"       : 3,
    "color"              : "#393FDB",
    "shadow"             : true,
    "shadow_blur"        : 2,
    "inner_background"   : "true",
    "inner_bg_color"     : "#efefef"  
}

  var circles = function(ele ,radius ,stop_precent ,text){
    this.rib = radius;
    this.cWidth = circle.circle_width;
    this.canvas = document.querySelector(ele);
    this.label = document.querySelector(text);
    this.precentCounter = 0;
    this.canvas.height = this.rib; this.canvas.width = this.rib;
    this.loading_stop = stop_precent;
    this.radius = this.rib / 2;
    this.count = 0;
    this.ctx = this.canvas.getContext("2d");
    this.x ;this.y ;this.counter = 0 ;this.done = false;
    this.stopDrawing = false;
    this.start = false;
    this.adder = 0;

    // draw function
    this.draw =( x ,y ) => {
        this.ctx.beginPath();
        this.ctx.shadowBlur = circle.shadow_blur;
        this.ctx.shadowColor = circle.color;
        this.ctx.fillStyle = circle.color; 
        this.ctx.arc( this.x , this.y ,this.cWidth ,0 ,Math.PI * 2 );
        this.ctx.fill();
    }
        this.ctx.beginPath();
        this.ctx.fill();
        this.ctx.fillStyle = "#fff";
        this.ctx.arc(this.rib / 2 ,this.rib / 2 ,this.radius  ,0 ,Math.PI * 2);
        this.ctx.fill();

    if(circle.inner_background){
        this.ctx.beginPath();
        this.ctx.fill();
        this.ctx.fillStyle = circle.inner_bg_color;
        this.ctx.arc(this.rib / 2 ,this.rib / 2 ,this.radius - this.cWidth * 2 ,0 ,Math.PI * 2);
        this.ctx.fill();
    }

    this.movement = () => {
        if(!this.stopDrawing ){
            requestAnimationFrame(this.movement);
        }
        if(this.canvas.getBoundingClientRect().top <= innerHeight / 1.2 ){
            this.start = true;
        }
        if(this.start){
            this.x = this.rib / 2 + Math.sin(this.count) * ( this.rib / 2 - this.cWidth);
            this.y = this.rib / 2 + Math.cos(this.count) * ( this.rib / 2 - this.cWidth);
            this.draw(this.x ,this.y);
            if(!this.done){
                this.count -= 0.03;
                this.counter++;
            }
            // this.logic();
            if(this.counter == (this.loading_stop / 100 * 210) || Math.abs((this.loading_stop / 100 * 210) - this.counter) == .5){
                this.done = true;
                this.stopDrawing = true;
            }
            
            this.adder = (this.loading_stop) / (this.loading_stop / 100 * 210);
            this.precentCounter += this.adder;
            if(this.label != null && this.precentCounter <= stop_precent ){
                this.label.innerHTML = Math.ceil(this.precentCounter) + "%";
            }
        }
    }
    this.movement();

    // logic 
    // this.logic = () => {
    //     if(this.counter == (this.loading_stop / 100 * 210) || Math.abs((this.loading_stop / 100 * 210) - this.counter) == .5){
    //         this.done = true;
    //         this.stopDrawing = true;
    //     }
    // }
}