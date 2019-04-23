<form action="/dashboard/{{$model}}/delete" method="post">
  @csrf
  <input type="checkbox" class="modal-check" id="deletemodal">

  <div class="modal">
    <label for="deletemodal" class="modal-background"></label>
    <div class="modal-header bg-white container">
      <div class="flex-wrap flex-sbc py-3">
        <div class="h4 m-0">Delete?</div>
      </div>
    </div>
    <div class="modal-body bg-white container">
      <section class="py-3 text-right">
        <p>Are you sure you would like to delete this item?</p>
        <label for="deletemodal" class="btn btn-white py-3 px-4 text-dark">Cancel</label>
        <button type="submit" class="btn btn-red py-3 px-4" name="id" :value="deleteid">Delete</button>
      </section>
    </div>
  </div>
</form>