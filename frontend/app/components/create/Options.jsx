import {Box, Stack, RadioGroup, Radio, Select, Button, Heading} from "@chakra-ui/react";
import { useState } from "react";
import NInput from "@/app/components/NInput";
import { SearchIcon } from '@chakra-ui/icons'
import Input from "@/app/components/Input";
import PurchaseData from "@/app/components/PurchaseData";
import {getPurchaseData} from "@/app/util/jurData";

export default function Options({ optionsData, formData, setFormData, propPurchase, isCreate }) {
    const [purchase, setPurchase] = useState({});

    return (
        <Box>
            <Box as='label'>
                Наименование клиента или ИНН
                <Input mt="8px" def={optionsData.value} onChange={(e) => setFormData({...formData, title: e})} />
            </Box>

            <Box mt="16px">
                <Box as='label'>
                    Cумма банковской гарантии
                    <NInput def={formData.sum_bg} mt="8px" onChange={(e) => setFormData({...formData, sum_bg: e.target.value})} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as='label'>
                    Наличие аванса
                    <RadioGroup onChange={(e) => setFormData({...formData, has_prepaid: e})} value={formData.has_prepaid} mt="8px">
                        <Stack direction='row'>
                            <Radio value='1'>Да</Radio>
                            <Radio value='2'>Нет</Radio>
                        </Stack>
                    </RadioGroup>
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    Тип гарантии
                    <Select value={formData.type} placeholder='Выберите тип' onChange={(e) => setFormData({...formData, type: e.target.value})}>
                        <option value='1'>Исполнение</option>
                        <option value='2'>Участие</option>
                        <option value='3'>БГОГ</option>
                        <option value='4'>Возврат аванса</option>
                    </Select>
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label" mt="16px">
                    Мультилот
                    <Select value={formData.multi_lot} placeholder='Выберите значение' onChange={(e) => setFormData({...formData, multi_lot: e.target.value})}>
                        <option value='1'>Нет</option>
                        <option value='2'>Да</option>
                    </Select>
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    Cумма контракта
                    <NInput mt="8px" def={formData.sum_deal} onChange={(e) => setFormData({...formData, sum_deal: e.target.value})} />
                </Box>
            </Box>

            <Heading size="md" mt="16px">Информация по аукциону</Heading>

            <Box mt="16px">
                <Box as="label">
                    Реестровый номер торгов по 44 ФЗ:
                    <Stack direction="horizontal">
                        <Input def={formData.auc} mt="8px" width="90%"
                            onChange={(e) => setFormData({...formData, auc: e})} />
                        {!isCreate ? '' :
                            <Button mt="8px" colorScheme="blue"
                                    onClick={() => getPurchaseData(formData.auc, setPurchase)}>
                                <SearchIcon/>
                            </Button>
                        }
                    </Stack>
                </Box>
            </Box>

            {
                propPurchase?.max_price ? <PurchaseData purchaseData={propPurchase} /> : ''
            }

            {
                purchase?.max_price ? <PurchaseData purchaseData={purchase} /> : ''
            }
        </Box>
    );
}