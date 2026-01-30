<?php
// ASUMIMOS que la clase Pedido está definida y disponible
class PedidosDB {
    private const DB_PATH = __DIR__ . '/pedidos.db';

    // Conexión y Creación de la Tabla 'pedidos'
    private static function konektatu(): PDO {
        try {
            $db = new PDO("sqlite:" . self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Crear tabla si no existe (incluida en konektatu, como en el ejemplo)
            $db->exec("CREATE TABLE IF NOT EXISTS pedidos (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                email TEXT NOT NULL,
                producto TEXT NOT NULL,
                cantidad INTEGER DEFAULT 1,
                estado TEXT DEFAULT 'Nuevo',
                fecha DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            return $db;
        } catch (PDOException $e) {
            die("Error de conexión a pedidos.db: " . $e->getMessage());
        }
    }
// ---------------------------------------------------------------------

    /**
     * Obtener un pedido por ID.
     */
    public static function selectPedidos(int $id): ?Pedidos {
        try {
            $db = self::konektatu();
            $stmt = $db->prepare("SELECT * FROM pedidos WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) return null;

            $p = new Pedidos();
            $p->setId((int)$row['id']);
            $p->setNombre($row['nombre']);
            $p->setEmail($row['email']);
            $p->setProducto($row['producto']);
            $p->setCantidad((int)$row['cantidad']);
            $p->setEstado($row['estado']);
            $p->setFecha($row['fecha']);
            return $p;
        } catch (Exception $e) {
            echo "Error en selectPedidos: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Actualizar estado del pedido (eskariak aldatu).
     */
    public static function updateEstadoPedidos(int $id, string $estado_nuevo): int {
        try {
            $db = self::konektatu();
            $sql = "UPDATE pedidos SET estado=:estado WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':estado' => $estado_nuevo,
                ':id' => $id
            ]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo "Error en updateEstadoPedidos: " . $e->getMessage();
            return 0;
        }
    }

    /**
     * Eliminar pedido (eskariak ezabatu).
     */
    public static function deletePedidos(int $id): int {
        try {
            $db = self::konektatu();
            $stmt = $db->prepare("DELETE FROM pedidos WHERE id=?");
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo "Error en deletePedidos: " . $e->getMessage();
            return 0;
        }
    }
}