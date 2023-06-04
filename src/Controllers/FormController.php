<?php

namespace Loja\Controllers;
use Loja\Models\Category;

class FormController extends MainController
{
   public function create(array $data): void
   {
      $data = filter_var_array($data, FILTER_SANITIZE_STRING);

      if (in_array("", $data)) {
         $callback["message"] = "Por favor, informe todos os campos!";
         echo json_encode($callback);

         return;
      }

      $category = new Category();
      $category->nome = $data["nome"];
      $category->save();
      
      $callback["message"] = "";
      $callback["category"] = $this->view->render("fragments/category", ["category" => $category]);
      echo json_encode($callback);
   }

   public function update(array $data): void
   {
      if (empty($data["id"])) {
         return;
      }

      $id = filter_var($data["id"], FILTER_VALIDATE_INT);
      $data = filter_var_array($data, FILTER_SANITIZE_STRING);

      if (in_array("", $data)) {
         $callback["message"] = "Por favor, informe todos os campos!";
         echo json_encode($callback);

         return;
      }

      $category = (new Category())->findById($id);
      $category->nome = $data["nome"];
      $category->save();
      
      $callback["message"] = "";
      $callback["category"] = $this->view->render("fragments/category", ["category" => $category]);

      echo json_encode($callback);
   }

   public function delete(array $data): void
   {
      if (empty($data["id"])) {
         return;
      }

      $id = filter_var($data["id"], FILTER_VALIDATE_INT);

      $category = (new Category())->findById($id);
      $callback["messages"] = "";

      if ($category) {
         if ($category->destroy()) {
            $callback["remove"] = true;
         } else {
            $callback["remove"] = false;
            $callback["messages"] = "Não foi possível excluir este campo!";
         }
      }

      echo json_encode($callback);
   }
}