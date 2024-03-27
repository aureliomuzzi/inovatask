<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Perfil</h3>
    </div>
    <div class="card-body text-center">
        <input  type="checkbox"
            data-handle-width="100"
            id="profile"
            name="profile"
            data-onstyle="dark"
            data-offstyle="info"
            value= "1", {{ $profile == 1 ? 'checked' : 0  }}
        />
    </div>
</div>
