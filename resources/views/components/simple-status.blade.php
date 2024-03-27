<div class="card-body text-center">
    <input  type="checkbox"
        data-handle-width="100"
        id="status"
        name="status"
        data-onstyle="success"
        data-offstyle="danger"
        value= "1", {{ $status == 1 ? 'checked' : 0  }}
    />
</div>
