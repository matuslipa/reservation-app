<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'reservation_time' => [
                'required',
                'date',
                function (string $attribute, ?string $value, callable $fail): void {
                    if ($value) {
                        $this->validateTableDate($value, (int)$this->get('restaurant_table_id'),$fail);
                    }
                },
            ],

        ];
    }

    /**
     * @param string $value
     * @param int $tableId
     * @param callable $fail
     *
     * @return void
     */
    private function validateTableDate(string $value,int $tableId, callable $fail): void
    {
        $reservations = Reservation::where('restaurant_table_id', $tableId)
            ->where('reservation_time', $value)
            ->count();

        if ($reservations > 0) {
            $fail('The table is already booked at this time.');
        }
    }
}
