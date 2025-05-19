export const StoreReducer = (state, action) => {
  switch (action.type) {
    case "SUCCESS":
      return {
        ...state,
        success: action.payload,
      };

    case "ERROR":
      return {
        ...state,
        error: action.payload,
      };

    case "MESSAGE":
      return {
        ...state,
        message: action.payload,
      };
    case "ARCHIVE":
      return {
        ...state,
        archive: action.payload,
      };
    case "RESTORE":
      return {
        ...state,
        restore: action.payload,
      };
    case "DELETE":
      return {
        ...state,
        delete: action.payload,
      };

    case "IS_SEARCH":
      return {
        ...state,
        isSearch: action.payload,
      };

    default:
      return state;
  }
};
