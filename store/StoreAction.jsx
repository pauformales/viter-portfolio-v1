export const setSuccess = (val) => {
  return {
    type: "SUCCESS",
    payload: val,
  };
};
export const setError = (val) => {
  return {
    type: "ERROR",
    payload: val,
  };
};
export const setMessage = (val) => {
  return {
    type: "MESSAGE",
    payload: val,
  };
};

export const setArchive = (val) => {
  return {
    type: "ARCHIVE",
    payload: val,
  };
};

export const setRestore = (val) => {
  return {
    type: "RESTORE",
    payload: val,
  };
};

export const setDelete = (val) => {
  return {
    type: "DELETE",
    payload: val,
  };
};

export const setIsSearch = (val) => {
  return {
    type: "IS_SEARCH",
    payload: val,
  };
};
