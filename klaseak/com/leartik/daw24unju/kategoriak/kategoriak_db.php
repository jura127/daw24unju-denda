<?php
class CategoriasDB {
    private const DB_PATH = __DIR__ . '/categorias.db';

    private static function konektatu(): PDO {
        $db = new PDO("sqlite:" . self::DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    // Crear tabla si no existe
    public static function crearTablaSiNoExiste() {
        $db = self::konektatu();
        $sql = "CREATE TABLE IF NOT EXISTS categorias (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL
        )";
        $db->exec($sql);
    }

    public static function selectCategorias(): array {
        $db = self::konektatu();
        $stmt = $db->query("SELECT * FROM categorias");
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $c = new Categorias();
            $c->setId((int)$row['id']);
            $c->setNombre($row['nombre']);
            $result[] = $c;
        }
        return $result;
    }

    public static function selectCategoria(int $id): ?Categorias {
        $db = self::konektatu();
        $stmt = $db->prepare("SELECT * FROM categorias WHERE id=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        $c = new Categorias();
        $c->setId((int)$row['id']);
        $c->setNombre($row['nombre']);
        return $c;
    }

    public static function insertCategoria(Categorias $c): int {
        $db = self::konektatu();
        $stmt = $db->prepare("INSERT INTO categorias(nombre) VALUES(:nombre)");
        $stmt->execute([':nombre' => $c->getNombre()]);
        return (int)$db->lastInsertId();
    }

    public static function updateCategoria(Categorias $c): int {
        $db = self::konektatu();
        $stmt = $db->prepare("UPDATE categorias SET nombre=:nombre WHERE id=:id");
        $stmt->execute([
            ':nombre' => $c->getNombre(),
            ':id' => $c->getId()
        ]);
        return $stmt->rowCount();
    }

    public static function deleteCategoria(int $id): int {
        $db = self::konektatu();
        $stmt = $db->prepare("DELETE FROM categorias WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
