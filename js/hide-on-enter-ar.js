/* global AFRAME */
AFRAME.registerComponent('hide-on-enter-ar', {
    init: function () {
      var self = this;
      
      this.el.sceneEl.addEventListener('exit-vr', function () {
        self.el.object3D.visible = true;
      });
    }
  });