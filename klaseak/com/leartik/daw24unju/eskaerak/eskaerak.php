<?php
class Pedidos {
    private int $id = 0;
    private string $nombre = '';
    private string $email = '';
    private string $producto = '';
    private int $cantidad = 0;
    private string $estado = ''; 
    private string $fecha = ''; 


    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
    
    public function getProducto(): string {
        return $this->producto;
    }
    
    public function getCantidad(): int {
        return $this->cantidad;
    }
    
    public function getEstado(): string {
        return $this->estado;
    }
    
    public function getFecha(): string {
        return $this->fecha;
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

    public function setProducto(string $producto): void {
        $this->producto = $producto;
    }
    
    public function setCantidad(int $cantidad): void {
        $this->cantidad = $cantidad;
    }

    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }
    
    public function setFecha(string $fecha): void {
        $this->fecha = $fecha;
    }
}
?>