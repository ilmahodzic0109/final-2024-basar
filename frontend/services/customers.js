var CustomersService = {
  getCustomers: async () => {
    return $.ajax({
      url: Constants.get_api_base_url() + "customers",
      type: "GET",
      dataType: "json",
      success: (data) => data,
      error: (xhr, status, error) => [],
    });
  },

  addCustomer: async (data) => {
    return $.ajax({
      url: Constants.get_api_base_url() + "customers/add",
      type: "POST",
      data,
      dataType: "json",
      success: (data) => data,
      error: (xhr, status, error) => [],
    });
  },

  getMealsForCustomer: async (id) => {
    return $.ajax({
      url: Constants.get_api_base_url() + "customer/meals/" + id,
      type: "GET",
      dataType: "json",
      success: (data) => data,
      error: (xhr, status, error) => [],
    });
  },
};
