<?php
class ProductosDB {
    private const DB_PATH = __DIR__ . '/productos.db';

    // Conexión a la base de datos SQLite
    private static function konektatu(): PDO {
        try {
            $db = new PDO("sqlite:" . self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Crear tabla si no existe
            $db->exec("CREATE TABLE IF NOT EXISTS productos (
                id_producto INTEGER PRIMARY KEY AUTOINCREMENT,
                tipo_producto TEXT NOT NULL,
                descripcion TEXT NOT NULL,
                precio REAL NOT NULL,
                id_categoria INTEGER NOT NULL,
                video TEXT,
                tiene_opc_añadir_cesta INTEGER DEFAULT 0,
                ofertas INTEGER DEFAULT 0,
                novedades INTEGER DEFAULT 0
            )");
            return $db;
        } catch (PDOException $e) {
            die("Error de conexión a DB: " . $e->getMessage());
        }
    }

    // Obtener todos los productos
    public static function selectProduktuak(): ?array {
        try {
            $db = self::konektatu();
            $stmt = $db->query("SELECT * FROM productos");
            $productos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $p = new Productos();
                $p->setIdProducto((int)$row['id_producto']);
                $p->setTipoProducto($row['tipo_producto']);
                $p->setDescripcion($row['descripcion']);
                $p->setPrecio((float)$row['precio']);
                $p->setIdCategoria((int)$row['id_categoria']);
                $p->setVideo($row['video'] ?? '');
                $p->setTieneOpcAñadirCesta((bool)$row['tiene_opc_añadir_cesta']);
                $p->setOfertas((bool)$row['ofertas']);
                $p->setNovedades((bool)$row['novedades']);
                $productos[] = $p;
            }
            return $productos;
        } catch (Exception $e) {
            echo "Error en selectProduktuak: " . $e->getMessage();
            return null;
        }
    }

    // Obtener producto por ID
    public static function selectProducto(int $id): ?Productos {
        try {
            $db = self::konektatu();
            $stmt = $db->prepare("SELECT * FROM productos WHERE id_producto = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) return null;

            $p = new Productos();
            $p->setIdProducto((int)$row['id_producto']);
            $p->setTipoProducto($row['tipo_producto']);
            $p->setDescripcion($row['descripcion']);
            $p->setPrecio((float)$row['precio']);
            $p->setIdCategoria((int)$row['id_categoria']);
            $p->setVideo($row['video'] ?? '');
            $p->setTieneOpcAñadirCesta((bool)$row['tiene_opc_añadir_cesta']);
            $p->setOfertas((bool)$row['ofertas']);
            $p->setNovedades((bool)$row['novedades']);
            return $p;
        } catch (Exception $e) {
            echo "Error en selectProducto: " . $e->getMessage();
            return null;
        }
    }

    // Insertar producto
    public static function insertProducto(Productos $p): int {
        try {
            $db = self::konektatu();
            $sql = "INSERT INTO productos 
                (tipo_producto, descripcion, precio, id_categoria, video, tiene_opc_añadir_cesta, ofertas, novedades)
                VALUES (:tipo, :desc, :precio, :cat, :video, :addcart, :ofertas, :novedades)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':tipo' => $p->getTipoProducto(),
                ':desc' => $p->getDescripcion(),
                ':precio' => $p->getPrecio(),
                ':cat' => $p->getIdCategoria(),
                ':video' => $p->getVideo(),
                ':addcart' => $p->getTieneOpcAñadirCesta() ? 1 : 0,
                ':ofertas' => $p->getOfertas() ? 1 : 0,
                ':novedades' => $p->getNovedades() ? 1 : 0
            ]);
            return (int)$db->lastInsertId();
        } catch (Exception $e) {
            echo "Error en insertProducto: " . $e->getMessage();
            return 0;
        }
    }

    // Actualizar producto
    public static function updateProducto(Productos $p): int {
        try {
            $db = self::konektatu();
            $sql = "UPDATE productos SET
                tipo_producto=:tipo,
                descripcion=:desc,
                precio=:precio,
                id_categoria=:cat,
                video=:video,
                tiene_opc_añadir_cesta=:addcart,
                ofertas=:ofertas,
                novedades=:novedades
                WHERE id_producto=:id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':tipo' => $p->getTipoProducto(),
                ':desc' => $p->getDescripcion(),
                ':precio' => $p->getPrecio(),
                ':cat' => $p->getIdCategoria(),
                ':video' => $p->getVideo(),
                ':addcart' => $p->getTieneOpcAñadirCesta() ? 1 : 0,
                ':ofertas' => $p->getOfertas() ? 1 : 0,
                ':novedades' => $p->getNovedades() ? 1 : 0,
                ':id' => $p->getIdProducto()
            ]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo "Error en updateProducto: " . $e->getMessage();
            return 0;
        }
    }

    // Eliminar producto
    public static function deleteProducto(int $id): int {
        try {
            $produktua = self::selectProducto($id);
            if (!$produktua) return 0;

            // Borrar vídeo si existe
            if ($produktua->getVideo() && file_exists(__DIR__ . '/../../' . $produktua->getVideo())) {
                @unlink(__DIR__ . '/../../' . $produktua->getVideo());
            }

            $db = self::konektatu();
            $stmt = $db->prepare("DELETE FROM productos WHERE id_producto=?");
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo "Error en deleteProducto: " . $e->getMessage();
            return 0;
        }
    }
}
?>
