function validateQty(qty) {
    qty = Number(qty);
    return (
        Number.isInteger(qty) &&
        qty > 0
    );
}