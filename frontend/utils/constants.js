var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost/final-2024/backend/rest/";
    } else {
      return "";
    }
  },
};
