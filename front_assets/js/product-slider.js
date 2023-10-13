window.onload = function(){
    var property = {
      element: "#product-slider-images",
      parallax: .6,
      interval: 3000,
      animDuration: 1300,
      easing: easingInOutQuad
    }
  
    var slider = new DXslider(property);
    slider.init();
  }
  
  class DXslider{
    constructor(property){
      this.images = document.querySelector(property.element);
      this.normalImages = document.querySelectorAll(".normal img");
      this.canvasBox = document.createElement("div");
      this.paraEffect = property.parallax; //have to clamp 0 ~ 1
      this.canvasArray = [];
      this.progress = 0;
      this.animating = false;
      this.interval = property.interval;
      this.left = true;
      this.duration = property.animDuration;
      this.easing = property.easing;
      
      this.images.appendChild(this.canvasBox);
      this.canvasBox.classList.add("product-slider-canvas");
    }
    
    init(){
      this.settingStyle();
      this.settingCanvas();
    }
    
    settingStyle(){
      this.imagesWidth = this.images.offsetWidth;
      this.width = this.normalImages[0].width;
      this.height = this.normalImages[0].height;
      this.dpi = this.width / this.imagesWidth;
      
      this.images.style.height = this.canvasBox.style.height = "400px";
    }
    
    settingCanvas(){
      var canvas, context, normal, n;
      for(var i = 0, len = this.normalImages.length * 2; i < len; i++){
        canvas = document.createElement("canvas");
        this.canvasBox.appendChild(canvas);
        context = canvas.getContext("2d");
      
        canvas.width = this.width;
        canvas.height = this.height;
        canvas.style.width = "1000px";
        canvas.style.height = "400px";
      
        n = i % (len / 2);
        normal = this.normalImages[n];
  
        this.canvasArray.push({
          canvas: canvas, context: context, normal: normal, 
        });
      }
      
      this.render(this.progress, -this.imagesWidth);
      this.timer = setTimeout(this.slide.bind(this), this.interval);
    }
    
    slide(){
      this.left ? 
      this.tween(-this.imagesWidth, this.duration, this.easing) :
      this.tween(this.imagesWidth, this.duration, this.easing);
    }
    
    tween(change, duration, easingFunc){
      var startTime = new Date();
      this.progress = 0;
      this.animating = true;
      this.update(startTime, change, duration, easingFunc);
    }
    
    update(startTime, change, duration, easingFunc){
      var time = new Date() - startTime;
      if(time < duration){
        this.progress = easingFunc(time / duration);
        this.render(this.progress, change);
        requestAnimationFrame(this.update.bind(this, startTime, change, duration, easingFunc));
      } else {
        if(this.left){
          var firstEle = this.canvasArray[0];
          this.canvasArray.shift();
          this.canvasArray.push(firstEle);
        } else {
          var lastEle = this.canvasArray[this.canvasArray.length - 1];
          this.canvasArray.pop();
          this.canvasArray.unshift(lastEle);
        }
        this.progress = 1;
        this.animating = false;
        time = duration;
        this.left = true;
        this.render(0, -this.imagesWidth);
        this.timer = setTimeout(this.slide.bind(this), this.interval);
      }
    }
    
    render(progress, position){
      for(var i = 0, len = this.canvasArray.length; i < len; i++){
        var canvas = this.canvasArray[i].canvas;
        canvas.style.setProperty("-webkit-transform", "translate(" + (progress * position - (len / 2 - i) * this.imagesWidth)  + "px, 0)");
        canvas.style.transform = "translate(" + (progress * position - (len / 2 - i) * this.imagesWidth)  + "px, 0)";
        
        var context = this.canvasArray[i].context;
        context.clearRect(0, 0, this.width, this.height);
        context.globalCompositeOperation = "source-over";
        context.drawImage(this.canvasArray[i].normal, 0, 0, this.width, this.height);
      }
    }
  }
  
  function easingInOutQuad(t){
    return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t; 
  }