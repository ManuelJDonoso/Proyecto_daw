
<?php

class Usuario {
    protected int $id;
    protected string $nombre_usuario;
    protected string $nombre;
    protected string $email;
    protected string $rol;

    public function __construct(int $id, string $nombre_usuario, string $nombre, string $email, string $rol) {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->rol = $rol;
    }

    public function crear_cuenta(): bool {
        return true;
    }

    public function set_id(int $id): void {
        $this->id = $id;
    }

    public function set_nombre_usuario(string $nombre_usuario): void {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function set_nombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function set_email(string $email): void {
        $this->email = $email;
    }

    public function set_rol(string $rol): void {
        $this->rol = $rol;
    }

    public function get_id(): int {
        return $this->id;
    }

    public function get_nombre_usuario(): string {
        return $this->nombre_usuario;
    }
}

class Jugador extends Usuario {
    public function __construct(int $id, string $nombre_usuario, string $nombre, string $email) {
        parent::__construct($id, $nombre_usuario, $nombre, $email, "jugador");
    }

    public function crear_evento(): bool {
        return false;
    }

    public function asignar_rol(): bool {
        return false;
    }
}

class Moderador extends Usuario {
    public function __construct(int $id, string $nombre_usuario, string $nombre, string $email) {
        parent::__construct($id, $nombre_usuario, $nombre, $email, "moderador");
    }

    public function crear_evento(): bool {
        return true;
    }

    public function asignar_rol(): bool {
        return false;
    }
}

class Administrador extends Usuario {
    public function __construct(int $id, string $nombre_usuario, string $nombre, string $email) {
        parent::__construct($id, $nombre_usuario, $nombre, $email, "administrador");
    }

    public function crear_evento(): bool {
        return true;
    }

    public function asignar_rol(): bool {
        return true;
    }
}
