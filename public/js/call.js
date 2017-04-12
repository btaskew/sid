Vue.component('call', {
  template: `
  <div class="row ">
    <div class="col-md-8">
      <div class="panel panel-primary">

        <div class="panel-heading">
          <h3 class="panel-title">
            <slot name="title"></slot>
          </h3>
          <h3 class="panel-title">
            <slot name="urgent"></slot>
          </h3>
          <h4 class="panel-title date-created">
            Call Made: <slot name="call-made"></slot>
          </h4>
        </div>

        <div class="panel-body">
          <p>
            <slot name="body"></slot>
          </p>
          <div class="panel-bottom">
            <slot name="actions"></slot>
            <slot name="button"></slot>
          </div>
        </div>

      </div>
    </div>
  </div>

  `
})

new Vue({
  el: '#root',
});
