<?php
class Productos
{
    private int $idProducto = 0;
    private string $tipoProducto = '';
    private string $descripcion = '';
    private float $precio = 0.0;
    private int $idCategoria = 0;
    private string $video = ''; // 🆕 campo nuevo para guardar la ruta del video
    private bool $tieneOpcAñadirCesta = false;
    private bool $ofertas = false;
    private bool $novedades = false;

    // GETTERS
    public function getIdProducto(): int { return $this->idProducto; }
    public function getTipoProducto(): string { return $this->tipoProducto; }
    public function getDescripcion(): string { return $this->descripcion; }
    public function getPrecio(): float { return $this->precio; }
    public function getIdCategoria(): int { return $this->idCategoria; }
    public function getVideo(): string { return $this->video; }
    public function getTieneOpcAñadirCesta(): bool { return $this->tieneOpcAñadirCesta; }
    public function getOfertas(): bool { return $this->ofertas; }
    public function getNovedades(): bool { return $this->novedades; }

    // SETTERS
    public function setIdProducto(int $id) { $this->idProducto = $id; }
    public function setTipoProducto(string $tipo) { $this->tipoProducto = $tipo; }
    public function setDescripcion(string $desc) { $this->descripcion = $desc; }
    public function setPrecio(float $precio) { $this->precio = $precio; }
    public function setIdCategoria(int $idCat) { $this->idCategoria = $idCat; }
    public function setVideo(string $video) { $this->video = $video; }
    public function setTieneOpcAñadirCesta(bool $valor) { $this->tieneOpcAñadirCesta = $valor; }
    public function setOfertas(bool $valor) { $this->ofertas = $valor; }
    public function setNovedades(bool $valor) { $this->novedades = $valor; }
}
?>
