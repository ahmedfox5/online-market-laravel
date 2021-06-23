var animator = function (
  ele,
  property,
  start,
  end,
  loop,
  delay,
  startEvent,
  elementOFevent
) {
  this.ele = document.querySelector(ele);
  this.ele2 = ele;
  this.property = property;
  this.start = start;
  this.end = end;
  this.loop = loop;
  this.delay = delay;
  this.startEvent = startEvent;
  this.firstClick = true;
  this.elementOFevent = document.querySelector(elementOFevent);

  $(this.ele2).css(this.property, this.start);

  this.movement = () => {
    if (
      this.ele.getBoundingClientRect().top < innerHeight - 100 &&
      this.startEvent == null
    ) {
      if (this.delay != null) {
        setTimeout(this.fdelay, this.delay);
      } else {
        this.fdelay();
      }
    } else if (
      loop &&
      this.ele.getBoundingClientRect().top > innerHeight &&
      this.startEvent == null
    ) {
      $(this.ele2).css(this.property, this.start);
    }

    if (this.startEvent != null && this.startEvent == "click") {
      this.eventFunc();
    } else if (this.startEvent != null && this.startEvent == "mousedown") {
      this.eventFunc();
      addEventListener("mouseup", this.eventFunc);
    } else if (this.startEvent != null && this.startEvent == "mouseenter") {
      this.eventFunc();
      addEventListener("mouseleave", this.eventFunc);
    }
  };

  this.eventFunc = () => {
    if (this.firstClick) {
      this.firstClick = false;
      $(this.ele2).css(this.property, this.start);
    } else {
      this.firstClick = true;
      if (this.delay != null) {
        setTimeout(this.fdelay, this.delay);
      } else {
        this.fdelay();
      }
    }
  };

  this.fdelay = () => {
    $(this.ele2).css("transition", "all 1s");
    $(this.ele2).css(this.property, this.end);
  };

  this.movement();

  if (this.startEvent == null) {
    addEventListener("scroll", this.movement);
  }

  if (this.startEvent != null) {
    this.elementOFevent.addEventListener(this.startEvent, this.movement);
  }
};

// animations
new animator(".ani1 ", "left", "-100vw", "0", true, 0);
new animator(".ani2 ", "left", "-100vw", "0", true, 250);
new animator(".ani3 ", "left", "-100vw", "0", true, 500);
new animator(".ani4 ", "left", "-100vw", "0", true, 750);

new animator(".ani5 ", "left", "100vw", "0", true, 0);
new animator(".ani6 ", "left", "100vw", "0", true, 250);
new animator(".ani7 ", "left", "100vw", "0", true, 500);
new animator(".ani8 ", "left", "100vw", "0", true, 750);

new animator(".ani9 ", "left", "-100vw", "0", true, 0);
new animator(".ani10", "left", "-100vw", "0", true, 250);
new animator(".ani11", "left", "-100vw", "0", true, 500);
new animator(".ani12", "left", "-100vw", "0", true, 750);

new animator(".ani13", "left", "100vw", "0", true, 0);
new animator(".ani14", "left", "100vw", "0", true, 250);
new animator(".ani15", "left", "100vw", "0", true, 500);
new animator(".ani16", "left", "100vw", "0", true, 750);

new animator(".ani17", "left", "-100vw", "0", true, 0);
new animator(".ani18", "left", "-100vw", "0", true, 250);
new animator(".ani19", "left", "-100vw", "0", true, 500);
new animator(".ani20", "left", "-100vw", "0", true, 750);

// communications animations

new animator(".comm-form input", "left", "-100vw", "0", true, 300);
new animator(".comm-form textarea", "left", "-100vw", "0", true, 400);
new animator(".comm-form button", "left", "-100vw", "0", true, 500);
