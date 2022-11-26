<?php
interface Crud{
public function ReadObj($data);
public function DeleteObj($data);
public function UpdateObj($data);
public function CreateObj($data);
}
