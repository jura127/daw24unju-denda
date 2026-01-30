<?php
class Mensajes {
    private int $id = 0;
    private string $nombre = '';
    private string $email = '';
    private string $mensaje = '';
    private string $fecha = ''; 
    private int $leido = 0; 



    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
    
    public function getMensaje(): string {
        return $this->mensaje;
    }
    
    public function getFecha(): string {
        return $this->fecha;
    }
    
    public function getLeido(): int {
        return $this->leido;
    }



    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setMensaje(string $mensaje): void {
        $this->mensaje = $mensaje;
    }
    
    public function setFecha(string $fecha): void {
        $this->fecha = $fecha;
    }

    public function setLeido(int $leido): void {
        $this->leido = $leido;
    }
}
?>