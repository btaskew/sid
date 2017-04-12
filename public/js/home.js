Vue.component('notification', {
  template: `
    <div class="row ">
      <div class="col-md-8">
        <div class="panel panel-primary">

          <div class="panel-heading">
            <h3 class="panel-title">
              <slot name="header"></slot>
            </h3>
            <slot name="delete"></slot>
          </div>

          <div class="panel-body">
              <slot></slot>
          </div>

        </div>
      </div>
    </div>
  `
})

new Vue({
  el: '#root',
});
