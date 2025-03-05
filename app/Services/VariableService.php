<?php
namespace App\Services;

use App\Models\Variable;

class VariableService
{
    public function saveVariable(array $data)
    {
        return Variable::create($data);
    }

    public function updateVariable($id, $data)
    {
        // Find the variable by ID
        $variable = Variable::find($id);

        if (!$variable) {
            return false; // Return false if not found
        }

        // Update the variable
        $variable->variable = $data['variable'];
        $variable->label = $data['label'];
        $variable->category = $data['category'];

        // Save changes and return the updated variable
        return $variable->save() ? $variable : false;
    }

    public function deleteVariable(Variable $variable)
    {
        return $variable->delete();
    }
}
