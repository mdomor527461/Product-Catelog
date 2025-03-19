@extends('layouts.master')
@section('content')
    <div class="flex-1 py-2 rounded-lg overflow-y-auto dark:bg-gray-600">
        <div class="sm:max-w-full w-[60%] mx-auto xm bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <div class="sales-report">
                <div class="bg-white px-2 py-2 rounded-lg shadow-md">
                    <div class="flex justify-end items-center mb-4">
                        <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700" onclick="openModal()">
                            Add new
                        </button>
                    </div>

                    <!-- Modal -->
                    <div id="modal"
                        class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
                        <div class="bg-white p-6 rounded-lg max-w-2xl w-full shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-2xl font-semibold">Add Product</h2>
                                <button type="button" class="text-red-500 text-[50px] p-4"
                                    onclick="closeModal()">&times;</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Product Name</label>
                                    <input type="text" id="productName" placeholder="Enter Product Name"
                                        class="w-full border rounded-md p-2" required />
                                </div>
                                <div>
                                    <label class="block text-gray-700">Price in USD</label>
                                    <input type="number" id="productPrice" placeholder="Enter Product Price"
                                        class="w-full border rounded-md p-2" required />
                                </div>
                            </div>

                            <div class="mt-6 text-center">
                                <button type="button" id="saveButton" onclick="addProduct()"
                                    class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">
                                    Save
                                </button>
                            </div>

                        </div>
                    </div>
                    <!-- Modal End -->

                    <!-- Product Table -->
                    <div class="bg-white rounded-lg shadow-md max-w-sm sm:max-w-full">
                        <div class="overflow-x-auto  max-w-full">
                            <table class="w-[100%] mx-auto border border-gray-300" id="productsTable">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-700">
                                        <th class="px-4 py-2 border">S. No</th>
                                        <th class="px-4 py-2 border">Name</th>
                                        <th class="px-4 py-2 border">Price (in USD)</th>
                                        <th class="px-4 py-2 border">Add to Cart</th>
                                        <th class="px-4 py-2 border">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Table End -->
                </div>
            </div>
        </div>
    </div>

    {{-- cart modal sstart  --}}
    <div id="cartModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Shopping Cart</h2>
                <button type="button" class="text-red-500 text-[50px] p-4" onclick="closeCart()">&times;</button>
            </div>

            <div id="cartItems" class="mb-4">

            </div>

            <hr class="border-gray-300 my-4">

            <div class="flex justify-between text-xl font-bold">
                <span>Total:</span>
                <span id="totalPrice">$0.00</span>
            </div>
        </div>
    </div>
    {{-- cart modal end --}}
@endsection
