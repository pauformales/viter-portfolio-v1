export const getCategoryDataById = (id, categoryData) => {
  let result = null;

  categoryData?.data.map((item) => {
    if (Number(item.category_aid) === Number(id)) {
      result = item;
    }
  });

  return result;
};
