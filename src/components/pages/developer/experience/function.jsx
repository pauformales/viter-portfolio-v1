export const CategoryLabel = ({ id, categories }) => {
  const category = categories.find((c) => c.category_aid === id);
  return <span>{category ? category.category_name : "Unspecified"}</span>;
};
